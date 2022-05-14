<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filter;

trait ColumnHelpers
{
    /**
     * @return DataTableComponent|null
     */
    public function getComponent(): ?DataTableComponent
    {
        return $this->component;
    }

    /**
     * @return bool
     */
    public function hasFrom(): bool
    {
        return $this->from !== null;
    }

    /**
     * @return string|null
     */
    public function getFrom(): ?string
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return Str::slug($this->title);
    }

    /**
     * @return string|null
     */
    public function getField(): ?string
    {
        return $this->field;
    }

    /**
     * @param  string  $field
     *
     * @return bool
     */
    public function isField(string $field): bool
    {
        return $this->getField() === $field;
    }

    /**
     * @param  string  $column
     *
     * @return bool
     */
    public function isColumn(string $column): bool
    {
        return $this->getColumn() === $column;
    }

    /**
     * @param  string  $name
     *
     * @return bool
     */
    public function isColumnBySelectName(string $name): bool
    {
        return $this->getColumnSelectName() === $name;
    }

    /**
     * @return bool
     */
    public function hasField(): bool
    {
        return $this->getField() !== null;
    }

    /**
     * @return bool
     */
    public function isLabel(): bool
    {
        return ! $this->hasFrom() && ! $this->hasField();
    }

    /**
     * @return string|null
     */
    public function getTable(): ?string
    {
        return $this->table;
    }

    /**
     * @return string|null
     */
    public function getColumn(): ?string
    {
        return $this->getTable() . '.' . $this->getField();
    }

    /**
     * @return string|null
     */
    public function getColumnSelectName(): ?string
    {
        if ($this->isBaseColumn()) {
            return $this->getField();
        }

        return $this->getRelationString().'.'.$this->getField();
    }

    // TODO: Test
    public function renderContents(Model $row)
    {
        if ($this->shouldCollapseOnMobile() && $this->shouldCollapseOnTablet()) {
            throw new DataTableConfigurationException('You should only specify a columns should collapse on mobile OR tablet, not both.');
        }

        return $this->getContents($row);
    }

    // TODO: Test
    public function getContents(Model $row)
    {
        if ($this->isLabel()) {
            $value = call_user_func($this->getLabelCallback(), $row, $this);

            if ($this->isHtml()) {
                return new HtmlString($value);
            }

            return $value;
        }

        $value = $this->getValue($row);

        if ($this->hasFormatter()) {
            $value = call_user_func($this->getFormatCallback(), $value, $row, $this);

            if ($this->isHtml()) {
                return new HtmlString($value);
            }

            return $value;
        }

        return $value;
    }

    // TODO: Test
    public function getValue(Model $row)
    {
        if ($this->isBaseColumn()) {
            return $row->{$this->getField()};
        }

        return $row->{$this->getRelationString().'.'.$this->getField()};
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
    public function isSortable(): bool
    {
        return $this->hasField() && $this->sortable === true;
    }

    /**
     * @return bool
     */
    public function hasSortCallback(): bool
    {
        return $this->sortCallback !== null;
    }

    // TODO
    public function getSearchCallback(): ?callable
    {
        return $this->searchCallback;
    }

    public function isSearchable(): bool
    {
        return $this->hasField() && $this->searchable === true;
    }

    public function hasSearchCallback(): bool
    {
        return $this->searchCallback !== null;
    }

    /**
     * @return $this
     */
    public function collapseOnMobile(): self
    {
        $this->collapseOnMobile = true;

        return $this;
    }

    /**
     * @return bool
     */
    public function shouldCollapseOnMobile(): bool
    {
        return $this->collapseOnMobile;
    }

    /**
     * @return $this
     */
    public function collapseOnTablet(): self
    {
        $this->collapseOnTablet = true;

        return $this;
    }

    /**
     * @return bool
     */
    public function shouldCollapseOnTablet(): bool
    {
        return $this->collapseOnTablet;
    }

    /**
     * @return string
     */
    public function getSortingPillTitle(): string
    {
        if ($this->hasCustomSortingPillTitle()) {
            return $this->getCustomSortingPillTitle();
        }

        return $this->getTitle();
    }

    /**
     * @return string|null
     */
    public function getCustomSortingPillTitle(): ?string
    {
        return $this->sortingPillTitle;
    }

    /**
     * @return bool
     */
    public function hasCustomSortingPillTitle(): bool
    {
        return $this->getCustomSortingPillTitle() !== null;
    }

    /**
     * @return bool
     */
    public function hasCustomSortingPillDirections(): bool
    {
        return $this->sortingPillDirectionAsc !== null && $this->sortingPillDirectionDesc !== null;
    }

    /**
     * @param  string  $direction
     *
     * @return string
     */
    public function getCustomSortingPillDirections(string $direction): string
    {
        if ($direction === 'asc') {
            return $this->sortingPillDirectionAsc;
        }

        if ($direction === 'desc') {
            return $this->sortingPillDirectionDesc;
        }

        return __('N/A');
    }

    /**
     * @param  DataTableComponent  $component
     * @param  string  $direction
     *
     * @return string
     */
    public function getSortingPillDirection(DataTableComponent $component, string $direction): string
    {
        if ($this->hasCustomSortingPillDirections()) {
            return $this->getCustomSortingPillDirections($direction);
        }

        return $direction === 'asc' ? $component->getDefaultSortingLabelAsc() : $component->getDefaultSortingLabelDesc();
    }

    /**
     * @return bool
     */
    public function eagerLoadRelationsIsEnabled(): bool
    {
        return $this->eagerLoadRelations === true;
    }

    /**
     * @return bool
     */
    public function isReorderColumn(): bool
    {
        return $this->getField() === $this->component->getDefaultReorderColumn();
    }

    /**
     * @return bool
     */
    public function hasFormatter(): bool
    {
        return $this->formatCallback !== null;
    }

    /**
     * @return callable|null
     */
    public function getFormatCallback(): ?callable
    {
        return $this->formatCallback;
    }

    // TODO
    public function getLabelCallback(): ?callable
    {
        return $this->labelCallback;
    }

    /**
     * @return bool
     */
    public function isHtml(): bool
    {
        return $this->html === true;
    }

    // TODO
    public function view($view): self
    {
        $this->format(function ($value, $row, Column $column) use ($view) {
            return view($view)
                ->withValue($value)
                ->withRow($row)
                ->withColumn($column);
        });

        return $this;
    }

    /**
     * @param  callable  $callback
     *
     * @return $this
     */
    public function isVisible(): bool
    {
        return $this->hidden !== true;
    }

    /**
     * @return bool
     */
    public function isHidden(): bool
    {
        return $this->hidden === true;
    }

    /**
     * @return bool
     */
    public function isSelectable(): bool
    {
        return $this->selectable === true;
    }

    /**
     * @return bool
     */
    public function isSelected(): bool
    {
        return $this->selected === true;
    }

    /**
     * @return bool
     */
    public function hasSecondaryHeader(): bool
    {
        return $this->secondaryHeader === true;
    }

    /**
     * @return bool
     */
    public function hasSecondaryHeaderCallback(): bool
    {
        return $this->secondaryHeaderCallback !== null;
    }

    /**
     * @return mixed
     */
    public function getSecondaryHeaderCallback()
    {
        return $this->secondaryHeaderCallback;
    }

    /**
     * @return string
     */
    public function getSecondaryHeaderContents($rows)
    {
        $value = null;
        $callback = $this->getSecondaryHeaderCallback();

        if ($this->hasSecondaryHeaderCallback()) {
            if (is_callable($callback)) {
                $value = call_user_func($callback, $rows);

                if ($this->isHtml()) {
                    return new HtmlString($value);
                }
            } elseif ($callback instanceof Filter) {
                return $callback->render($this->getComponent());
            } elseif (is_string($callback)) {
                $filter = $this->getComponent()->getFilterByKey($callback);

                if ($filter instanceof Filter) {
                    return $filter->render($this->getComponent());
                }
            } else {
                throw new DataTableConfigurationException('The secondary header callback must be a closure, filter object, or filter key if using secondaryHeaderFilter().');
            }
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
     * @return bool
     */
    public function hasFooterCallback(): bool
    {
        return $this->footerCallback !== null;
    }

    /**
     * @return mixed
     */
    public function getFooterCallback()
    {
        return $this->footerCallback;
    }

    /**
     * @return string
     */
    public function getFooterContents($rows)
    {
        $value = null;
        $callback = $this->getFooterCallback();

        if ($this->hasFooterCallback()) {
            if (is_callable($callback)) {
                $value = call_user_func($callback, $rows);

                if ($this->isHtml()) {
                    return new HtmlString($value);
                }
            } elseif ($callback instanceof Filter) {
                return $callback->render($this->getComponent());
            } elseif (is_string($callback)) {
                $filter = $this->getComponent()->getFilterByKey($callback);

                if ($filter instanceof Filter) {
                    return $filter->render($this->getComponent());
                }
            } else {
                throw new DataTableConfigurationException('The footer callback must be a closure, filter object, or filter key if using footerFilter().');
            }
        }

        return $value;
    }

    /**
     * @return bool
     */
    public function arrayToAttributes(array $attributes)
    {
        return join(' ', array_map(function ($key) use ($attributes) {
            if (is_bool($attributes[$key])) {
                return $attributes[$key] ? $key : '';
            }
            
            return $key . '="' . $attributes[$key] . '"';
        }, array_keys($attributes)));
    }

    /**
     * @return bool
     */
    public function isClickable(): bool
    {
        return $this->clickable &&
            $this->component->hasTableRowUrl() &&
            ! $this instanceof LinkColumn;
    }
}
