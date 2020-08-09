<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

/**
 * Trait Checkboxes.
 */
trait Checkboxes
{
    /**
     * Whether or not checkboxes are enabled.
     *
     * @var bool
     */
    public $checkbox = false;

    /**
     * The side to put the checkboxes on.
     *
     * @var string
     */
    public $checkboxLocation = 'left';

    /**
     * The model attribute to bind to the checkbox array.
     *
     * @var string
     */
    public $checkboxAttribute = 'id';

    /**
     * Whether or not all checkboxes are currently selected.
     *
     * @var bool
     */
    public $checkboxAll = false;

    /**
     * The currently selected values of the checkboxes.
     *
     * @var array
     */
    public $checkboxValues = [];

    /**
     * Adds all the id's to the checkbox array.
     */
    public function updatedCheckboxAll(): void
    {
        $this->checkboxValues = [];

        if ($this->checkboxAll) {
            $this->models()->each(function ($model) {
                $this->checkboxValues[] = (string) $model->{$this->checkboxAttribute};
            });
        }
    }

    /**
     * Toggles the checkbox that selects/deselects all of the checkboxes.
     */
    public function updatedCheckboxValues(): void
    {
        $this->checkboxAll = false;
    }
}
