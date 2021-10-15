<?php

namespace Rappasoft\LaravelLivewireTables\Views;

use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

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
     * @var array
     */
    public array $attributes = [];

    /**
     * @var bool
     */
    public bool $sortable = false;

    /**
     * @var
     */
    public $sortCallback;

    /**
     * @var bool
     */
    public bool $searchable = false;

    /**
     * @var callable
     */
    public $searchCallback;

    /**
     * @var string|null
     */
    public ?string $class = null;

    /**
     * @var bool
     */
    public bool $blank = false;

    /**
     * @var
     */
    public $formatCallback;

    /**
     * @var bool
     */
    public bool $asHtml = false;

    /**
     * @var bool
     */
    public bool $hidden = false;

    /**
     * @var bool
     */
    public bool $selectable = true;

    /**
     * @var bool
     */
    public bool $selected = false;

    /**
     * @var bool
     */
    public bool $secondaryHeader = false;

    /**
     * @var
     */
    public $secondaryHeaderCallback;

    /**
     * @var bool
     */
    public bool $footer = false;

    /**
     * @var
     */
    public $footerCallback;

    /**
     * @var
     */
    public $linkCallback;

    /**
     * @var ?string
     */
    public ?string $linkTarget;

    /**
     * Column constructor.
     *
     * @param string|null $column
     * @param string|null $text
     */
    public function __construct(string $text = null, string $column = null)
    {
        $this->text = $text;

        if (! $column && $text) {
            $this->column = Str::snake($text);
        } else {
            $this->column = $column;
        }

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
    public static function make(string $text = null, string $column = null): Column
    {
        return new static($text, $column);
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
    public function isSearchable(): bool
    {
        return $this->searchable === true;
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
    public function sortable($callback = null): self
    {
        $this->sortable = true;

        $this->sortCallback = $callback;

        return $this;
    }

    /**
     * @param callable|null $callback
     * @return $this
     */
    public function searchable(callable $callback = null): self
    {
        $this->searchable = true;

        $this->searchCallback = $callback;

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
     * @param array $attributes
     *
     * @return $this
     */
    public function addAttributes(array $attributes): self
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @return Column
     */
    public function asHtml(): Column
    {
        $this->asHtml = true;

        return $this;
    }

    /**
     * @return bool
     */
    public function isHtml(): bool
    {
        return $this->asHtml === true;
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

    /**
     * @return array
     */
    public function attributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param  callable  $callable
     *
     * @return $this
     */
    public function format(callable $callable): Column
    {
        $this->formatCallback = $callable;

        return $this;
    }

    /**
     * @param $row
     * @param  null  $column
     *
     * @return array|mixed|null
     */
    public function formatted($row, $column = null)
    {
        if ($column instanceof self) {
            $columnName = $column->column();
        } elseif (is_string($column)) {
            $columnName = $column;
        } else {
            $columnName = $this->column();
        }

        $value = data_get($row, $columnName);

        if ($this->formatCallback) {
            $value = call_user_func($this->formatCallback, $value, $column, $row);
        }

        if ($this->linkCallback) {
            $url = call_user_func($this->linkCallback, $value, $column, $row);

            if ($url) {
                $linkTarget = $this->linkTarget ? "target='$this->linkTarget'" : '';
                $value = new HtmlString("<a href='$url' $linkTarget>$value</a>");
            }
        }

        return $value;
    }

    /**
     * @return bool
     */
    public function hasSortCallback(): bool
    {
        return $this->sortCallback !== null;
    }

    /**
     * @return callable|null
     */
    public function getSortCallback(): ?callable
    {
        return $this->sortCallback;
    }

    /**
     * @return bool
     */
    public function hasSearchCallback(): bool
    {
        return $this->searchCallback !== null;
    }

    /**
     * @return callable|null
     */
    public function getSearchCallback(): ?callable
    {
        return $this->searchCallback;
    }

    /**
     * @param $condition
     *
     * @return $this
     */
    public function hideIf($condition): self
    {
        $this->hidden = $condition;

        return $this;
    }

    /**
     * @return bool
     */
    public function isVisible(): bool
    {
        return $this->hidden !== true;
    }

    /**
     * @return $this
     */
    public function excludeFromSelectable(): self
    {
        $this->selectable = false;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSelectable(): bool
    {
        return $this->selectable === true;
    }

    /**
     * @return $this
     */
    public function selected(): self
    {
        $this->selected = true;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSelected(): bool
    {
        return $this->selected;
    }

    /**
     * @return bool
     */
    public function hasSecondaryHeader(): bool
    {
        return $this->secondaryHeader === true;
    }

    /**
     * @return $this
     */
    public function secondaryHeader($callback = null): self
    {
        $this->secondaryHeader = true;

        $this->secondaryHeaderCallback = $callback;

        return $this;
    }

    /**
     * @param $rows
     *
     * @return false|mixed|null
     */
    public function secondaryHeaderFormatted($rows)
    {
        $value = null;

        if ($this->secondaryHeaderCallback) {
            $value = call_user_func($this->secondaryHeaderCallback, $rows);
        }

        return $value;
    }

    /**
     * @return bool
     */
    public function hasFooter(): bool
    {
        return $this->footer === true;
    }

    /**
     * @return $this
     */
    public function footer($callback = null): self
    {
        $this->footer = true;

        $this->footerCallback = $callback;

        return $this;
    }

    /**
     * @param $rows
     *
     * @return false|mixed|null
     */
    public function footerFormatted($rows)
    {
        $value = null;

        if ($this->footerCallback) {
            $value = call_user_func($this->footerCallback, $rows);
        }

        return $value;
    }

    /**
     * @param  callable  $callable
     * @param  string|null  $target
     *
     * @return $this
     */
    public function linkTo(callable $callable, string $target = null): self
    {
        $this->linkCallback = $callable;
        $this->linkTarget = $target;

        return $this;
    }
}
