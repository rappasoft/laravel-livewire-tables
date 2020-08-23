<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

/**
 * Trait Table.
 */
trait Table
{
    /**
     * Table.
     */

    /**
     * Whether or not to display the table header.
     *
     * @var bool
     */
    public $tableHeaderEnabled = true;

    /**
     * Whether or not to display the table footer.
     *
     * @var bool
     */
    public $tableFooterEnabled = false;

    /**
     * The class to set on the table.
     *
     * @var string
     */
    public $tableClass = 'table table-striped';

    /**
     * The class to set on the thead of the table.
     *
     * @var string
     */
    public $tableHeaderClass = '';

    /**
     * The class to set on the tfoot of the table.
     *
     * @var string
     */
    public $tableFooterClass = '';

    /**
     * false is off
     * string is the tables wrapping div class.
     *
     * @var bool
     */
    public $responsive = 'table-responsive';

    /**
     * @param $attribute
     *
     * @return string|null
     */
    public function setTableHeadClass($attribute): ?string
    {
        return null;
    }

    /**
     * @param $attribute
     *
     * @return string|null
     */
    public function setTableHeadId($attribute): ?string
    {
        return null;
    }

    /**
     * @param $attribute
     *
     * @return array|null
     */
    public function setTableHeadAttributes($attribute): array
    {
        return [];
    }

    /**
     * @param $model
     *
     * @return string|null
     */
    public function setTableRowClass($model): ?string
    {
        return null;
    }

    /**
     * @param $model
     *
     * @return string|null
     */
    public function setTableRowId($model): ?string
    {
        return null;
    }

    /**
     * @param $model
     *
     * @return array
     */
    public function setTableRowAttributes($model): array
    {
        return [];
    }

    /**
     * @param $model
     *
     * @return string|null
     */
    public function getTableRowUrl($model): ?string
    {
        return null;
    }

    /**
     * @param $attribute
     * @param $value
     *
     * @return string|null
     */
    public function setTableDataClass($attribute, $value): ?string
    {
        return null;
    }

    /**
     * @param $attribute
     * @param $value
     *
     * @return string|null
     */
    public function setTableDataId($attribute, $value): ?string
    {
        return null;
    }

    /**
     * @param $attribute
     * @param $value
     *
     * @return array
     */
    public function setTableDataAttributes($attribute, $value): array
    {
        return [];
    }
}
