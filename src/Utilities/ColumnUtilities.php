<?php

namespace Rappasoft\LaravelLivewireTables\Utilities;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as Builder;
use Illuminate\Support\Str;

class ColumnUtilities
{
    /**
     * Grab the relation part of a column
     *
     * @param $column
     * @return bool
     */
    public static function hasRelation($column)
    {
        return Str::contains($column, '.');
    }

    /**
     * Grab the relation part of a column
     *
     * @param $column
     * @return string
     */
    public static function parseRelation($column)
    {
        return Str::beforeLast($column, '.');
    }

    /**
     * Grab the field part of a column
     *
     * @param $column
     * @return string
     */
    public static function parseField($column)
    {
        return Str::afterLast($column, '.');
    }

    /**
     * Is the column selected?
     *
     * @param $column
     * @param $searchColumns
     * @return bool
     */
    public static function hasMatch($column, $searchColumns)
    {
        return array_search($column, $searchColumns ?? []) !== false;
    }

    /**
     * Is the column selected by a wildcard match?
     *
     * @param $column
     * @param $searchColumns
     * @return bool
     */
    public static function hasWildcardMatch($column, $searchColumns)
    {
        return count(array_filter($searchColumns ?? [], function ($searchColumn) use ($column) {

                // match wildcards such as * or table.*
            $hasWildcard = Str::endsWith($searchColumn, '*');

            // if no wildcard, skip
            if (! $hasWildcard) {
                return false;
            }

            if (! self::hasRelation($column)) {
                return true;
            } else {
                $selectColumnPrefix = self::parseRelation($searchColumn);
                $columnPrefix = self::parseRelation($column);

                return $selectColumnPrefix === $columnPrefix;
            }
        })) > 0;
    }

    /**
     * @param EloquentBuilder|Builder $queryBuilder
     * @return null
     */
    public static function columnsFromBuilder($queryBuilder = null)
    {
        if ($queryBuilder instanceof EloquentBuilder) {
            return $queryBuilder->getQuery()->columns;
        } elseif ($queryBuilder instanceof Builder) {
            return $queryBuilder->columns;
        } else {
            return null;
        }
    }

    /**
     * Try to map a given column to an already selected column
     *
     * @param $column
     * @param $queryBuilder
     * @return string
     */
    public static function mapToSelected($column, $queryBuilder)
    {
        // grab select
        $select = self::columnsFromBuilder($queryBuilder);

        // can't match anything if no select
        if (is_null($select)) {
            return null;
        }

        // search builder select for a match
        $hasMatch = self::hasMatch($column, $select);

        // example 2 - match
        // column: service_statuses.name
        // select: service_statuses.name
        // maps to: service_statuses.name

        // if we found a match, lets use that instead of searching relations
        if ($hasMatch) {
            return $column;
        }

        // search builder select for a wildcard match
        $hasWildcardMatch = self::hasWildcardMatch($column, $select);

        // example 3 - wildcard match
        // column: service_statuses.name
        // select: service_statuses.*
        // maps to: service_statuses.name

        // if we found a wildcard match, lets use that instead of matching relations
        if ($hasWildcardMatch) {
            return $column;
        }

        // split the relation and field
        $hasRelation = self::hasRelation($column);
        $relationName = self::parseRelation($column);
        $fieldName = self::parseField($column);

        // we know there is a relation and we know it doesn't match any of the
        // select columns. Let's try to grab the table name for the relation
        // and see if that matches something in the select
        //
        // example 4 - relation to already selected table
        // column: serviceStatus.name
        // select: service_statuses.name
        // maps to: service_statuses.name

        // if we didn't previously match the column and there isn't a relation
        if (! $hasRelation) {

            // there's nothing else to do
            return null;

        // this is easiest when using the eloquent query builder
        } elseif ($queryBuilder instanceof EloquentBuilder) {
            $relation = $queryBuilder->getRelation($relationName);
            $possibleTable = $relation->getModel()->getTable();
        } elseif ($queryBuilder instanceof Builder) {

            // @todo: possible ways to do this?
            $possibleTable = null;
        } else {

            // we would have already returned before this is possible
            $possibleTable = null;
        }

        // if we found a possible table
        if (! is_null($possibleTable)) {

            // build possible selected column
            $possibleSelectColumn = $possibleTable . '.' . $fieldName;

            $possibleMatch = self::hasMatch($possibleSelectColumn, $select);

            // if we found a possible match for a relation to an already selected
            // column, let's use that
            if ($possibleMatch) {
                return $possibleSelectColumn;
            }

            $possibleWildcardMatch = self::hasWildcardMatch($possibleSelectColumn, $select);

            // ditto with a possible wildcard match
            if ($possibleWildcardMatch) {
                return $possibleSelectColumn;
            }
        }

        // we couldn't match to a selected column
        return null;
    }
}
