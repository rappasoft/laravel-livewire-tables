<?php

namespace Rappasoft\LivewireTables\Http\Livewire;

use Illuminate\Support\Str;

/**
 * Class Column.
 */
class Column
{
    /**
     * @var
     */
    protected $text;

    /**
     * @var string
     */
    protected $attribute;

    /**
     * @var bool
     */
    protected $searchable = false;

    /**
     * @var null
     */
    protected $searchCallback;

    /**
     * @var bool
     */
    protected $sortable = false;

    /**
     * @var
     */
    protected $sortCallback;

    /**
     * @var bool
     */
    protected $unescaped = false;

    /**
     * @var bool
     */
    protected $html = false;

    /**
     * This column is a custom attribute on the model and not a column in the database.
     *
     * @var bool
     */
    protected $customAttribute = false;

    /**
     * @var
     */
    protected $view;

    /**
     * Column constructor.
     *
     * @param $text
     * @param $attribute
     */
    public function __construct($text, $attribute)
    {
        $this->text = $text;
        $this->attribute = $attribute ?? Str::snake(Str::lower($text));
    }

    /**
     * @param $property
     *
     * @return mixed
     */
    public function __get($property)
    {
        return $this->$property;
    }

    /**
     * @param  null  $text
     * @param  null  $attribute
     *
     * @return static
     */
    public static function make($text = null, $attribute = null)
    {
        return new static($text, $attribute);
    }

    /**
     * @param  callable|null  $callable
     *
     * @return $this
     */
    public function searchable(callable $callable = null): self
    {
        $this->searchCallback = $callable;
        $this->searchable = true;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSearchable(): bool
    {
        return $this->searchable;
    }

    /**
     * @param  callable|null  $callable
     *
     * @return $this
     */
    public function sortable(callable $callable = null): self
    {
        $this->sortCallback = $callable;
        $this->sortable = true;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSortable(): bool
    {
        return $this->sortable;
    }

    /**
     * @return $this
     */
    public function unescaped(): self
    {
        $this->unescaped = true;

        return $this;
    }

    /**
     * @return bool
     */
    public function isUnescaped(): bool
    {
        return $this->unescaped;
    }

    /**
     * @return $this
     */
    public function html(): self
    {
        $this->html = true;

        return $this;
    }

    /**
     * @return bool
     */
    public function isHtml(): bool
    {
        return $this->html;
    }

    /**
     * @return $this
     */
    public function customAttribute(): self
    {
        $this->customAttribute = true;

        return $this;
    }

    /**
     * @return bool
     */
    public function isCustomAttribute(): bool
    {
        return $this->customAttribute;
    }

    /**
     * @param $view
     *
     * @return $this
     */
    public function view($view): self
    {
        $this->view = $view;

        return $this;
    }

    /**
     * @return bool
     */
    public function isView(): bool
    {
        return view()->exists($this->view);
    }
}
