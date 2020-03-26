<?php

namespace Rappasoft\LivewireTables\Http\Livewire\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;

/**
 * Trait Yajra
 *
 * @package Rappasoft\LivewireTables\Http\Livewire\Traits
 */
trait Yajra
{
    /**
     * @param $attribute
     *
     * @return object
     */
    public function relationship($attribute)
    {
        $parts = explode('.', $attribute);

        return (object)[
            'attribute' => array_pop($parts),
            'name' => implode('.', $parts),
        ];
    }

    /**
     * @param  Builder  $query
     * @param $relationships
     * @param $attribute
     *
     * @return string
     */
    public function attribute(Builder $query, $relationships, $attribute)
    {
        $table = '';
        $last_query = $query;

        foreach (explode('.', $relationships) as $each_relationship) {
            $model = $last_query->getRelation($each_relationship);

            switch (true) {
                case $model instanceof BelongsToMany:
                    $pivot = $model->getTable();
                    $pivotPK = $model->getExistenceCompareKey();
                    $pivotFK = $model->getQualifiedParentKeyName();
                    $query->leftJoin($pivot, $pivotPK, $pivotFK);

                    $related = $model->getRelated();
                    $table = $related->getTable();
                    $tablePK = $related->getForeignKey();
                    $foreign = $pivot . '.' . $tablePK;
                    $other = $related->getQualifiedKeyName();

                    $last_query->addSelect($table . '.' . $attribute);
                    $query->leftJoin($table, $foreign, $other);

                    break;

                case $model instanceof HasOneOrMany:
                    $table = $model->getRelated()->getTable();
                    $foreign = $model->getQualifiedForeignKeyName();
                    $other = $model->getQualifiedParentKeyName();
                    break;

                case $model instanceof BelongsTo:
                    $table = $model->getRelated()->getTable();
                    $foreign = $model->getQualifiedForeignKeyName();
                    $other = $model->getQualifiedOwnerKeyName();
                    break;

                default:
                    return $attribute;
            }

            $query->leftJoin($table, $foreign, $other);
            $last_query = $model->getQuery();
        }

        return $table . '.' . $attribute;
    }

    /**
     * @param $attribute
     *
     * @return mixed|null
     */
    protected function getColumnByAttribute($attribute)
    {
        foreach ($this->columns() as $col) {
            if ($col->attribute === $attribute) {
                return $col;
            }
        }

        return null;
    }
}
