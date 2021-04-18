<?php

namespace Rappasoft\LaravelLivewireTables\Utilities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
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
        return array_search($column, $searchColumns) !== false;
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
        return count(array_filter( $searchColumns ?? [], function($searchColumn) use ($column) {

            // match wildcards such as * or table.*
            $hasWildcard = Str::endsWith($searchColumn, '*');

            // if no wildcard, skip
            if(!$hasWildcard){
                return false;
            }

            $selectColumnPrefix = self::parseRelation($searchColumn);
            $columnPrefix = self::parseRelation($column);

            return $selectColumnPrefix === $columnPrefix;

        })) > 0;
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
        // get select columns from eloquent query builder
        if ($queryBuilder instanceof EloquentBuilder) {
            $select = $queryBuilder->getQuery()->columns;
        // get select columns from database query builder
        } elseif ($queryBuilder instanceof Builder) {
            $select = $queryBuilder->columns;
        // if no query builder, we can't match anything
        }else{
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
        // note: I think there's an argument if we even want to try and do
        //       this. It can help in some scenarios where a field is
        //       specifically selected in the select statement and
        //       then the relation dot-notation is used on the
        //       column name. However, perhaps it creates too
        //       much ambiguity?

        // example 4 - relation to already selected table
        // column: serviceStatus.name
        // select: service_statuses.name
        // maps to: service_statuses.name

        // if we didn't previously match the column and there isn't
        // a relation
        if (!$hasRelation) {

            // there's nothing else to do
            return null;

        // this is easiest when using the eloquent query builder
        } elseif ($queryBuilder instanceof EloquentBuilder) {

            $relation = $queryBuilder->getRelation($relationName);
            $possibleTable = $relation->getModel()->getTable();

        }elseif ($queryBuilder instanceof Builder) {

            // basically, there is no clean way to do this directly on
            // a database builder. we just start making a bunch of
            // assumptions to try and find a model and table name,
            // which probably doesn't even exist.

            $possibleModelName = str_replace('_', '', ucwords(Str::snake(Str::afterLast($relationName, '.')), '_'));
            $possibleModelClassName = 'App\Models\\' . $possibleModelName;

            if (class_exists($possibleModelClassName)) {

                /** @var Model $possibleModel */
                $possibleModel = new $possibleModelClassName;
                $possibleTable = $possibleModel->getTable();

            }else{
                $possibleTable = null;
            }

        }else{
            // we would have already returned before this is possible
            $possibleTable = null;
        }

        // if we found a possible table
        if (!is_null($possibleTable)) {

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
