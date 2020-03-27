<?php

namespace Rappasoft\LivewireTables\Http\Livewire\Traits;

/**
 * Trait Table
 *
 * @package Rappasoft\LivewireTables\Http\Livewire\Traits
 */
trait Table
{

    /**
     * Table
     */

    /**
     * Whether or not to display the table header
     *
     * @var bool
     */
    public $tableHeaderEnabled = true;



    /**
     * Whether or not to display the table footer
     *
     * @var bool
     */
    public $tableFooterEnabled = false;

    /**
     * The class to set on the table
     *
     * @var string
     */
    public $tableClass = 'table table-striped';

    /**
     * The class to set on the thead of the table
     *
     * @var string
     */
    public $tableHeaderClass = '';

    /**
     * The class to set on the tfoot of the table
     *
     * @var string
     */
    public $tableFooterClass = '';

    /**
     * false is off
     * string is the tables wrapping div class
     *
     * @var bool
     */
    public $responsive = 'table-responsive';

    /**
     * @param $attribute
     *
     * @return string|null
     */
    public function thClass($attribute) : ?string
    {
        return null;
    }

    /**
     * @param $model
     *
     * @return string|null
     */
    public function trClass($model) : ?string
    {
        return null;
    }

    /**
     * @param $attribute
     * @param $value
     *
     * @return string|null
     */
    public function tdClass($attribute, $value) : ?string
    {
        return null;
    }
}
