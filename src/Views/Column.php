<?php

namespace Rappasoft\LaravelLivewireTables\Views;

/**
 * Class Column.
 */
class Column
{
    /**
     * @var string|null
     */
    public ?string $column = null;

    /**
     * @var string|null
     */
    public ?string $text = null;

    /**
     * @var bool
     */
    public bool $sortable = false;

    /**
     * @var bool
     */
    public bool $multiColumn = false;

    /**
     * @var string|null
     */
    public ?string $class = null;

    /**
     * @var bool
     */
    public bool $blank = false;

    /**
     * Column constructor.
     *
     * @param string|null $column
     * @param string|null $text
     */
    public function __construct(string $column = null, string $text = null)
    {
        $this->column = $column;
        $this->text = $text;

        if (! $this->column && ! $this->text) {
            $this->blank = true;
        }
    }

    /**
     * @param string|null $column
     * @param string|null $text
     *
     * @return Column
     */
    public static function make(string $column = null, string $text = null): Column
    {
        return new static($column, $text);
    }

    /**
     * @return Column
     */
    public static function blank(): Column
    {
        return new static(null, null);
    }

    /**
     * @return bool
     */
    public function isSortable(): bool
    {
        return $this->sortable === true;
    }

    /**
     * @return bool
     */
    public function isMultiColumn(): bool
    {
        return $this->multiColumn === true;
    }

    /**
     * @return bool
     */
    public function isBlank(): bool
    {
        return $this->blank === true;
    }

    /**
     * @return $this
     */
    public function sortable(): self
    {
        $this->sortable = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function multiColumn(): self
    {
        $this->multiColumn = true;

        return $this;
    }

    /**
     * @param string $class
     *
     * @return $this
     */
    public function addClass(string $class): self
    {
        $this->class = $class;

        return $this;
    }

    /**
     * @return string|null
     */
    public function class(): ?string
    {
        return $this->class;
    }

    /**
     * @return string|null
     */
    public function column(): ?string
    {
        return $this->column;
    }

    /**
     * @return string|null
     */
    public function text(): ?string
    {
        return $this->text;
    }
}
