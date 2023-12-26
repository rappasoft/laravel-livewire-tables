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
    public function getComponent(): ?DataTableComponent
    {
        return $this->component;
    }

    public function hasFrom(): bool
    {
        return $this->from !== null;
    }

    public function getFrom(): ?string
    {
        return $this->from;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSlug(): string
    {
        return Str::slug($this->hasCustomSlug() ? $this->getCustomSlug() : $this->getTitle());
    }

    public function getField(): ?string
    {
        return $this->field;
    }

    public function isField(string $field): bool
    {
        return $this->getField() === $field;
    }

    public function isColumn(string $column): bool
    {
        return $this->getColumn() === $column;
    }

    public function isColumnBySelectName(string $name): bool
    {
        return $this->getColumnSelectName() === $name;
    }

    public function isColumnBySlug(string $slug): bool
    {
        return $this->getSlug() === $slug;
    }

    public function hasField(): bool
    {
        return $this->getField() !== null;
    }

    public function isLabel(): bool
    {
        return ! $this->hasFrom() && ! $this->hasField();
    }

    public function getTable(): ?string
    {
        return $this->table;
    }

    public function getColumn(): ?string
    {
        return $this->getTable().'.'.$this->getField();
    }

    public function getColumnSelectName(): ?string
    {
        if ($this->isBaseColumn()) {
            return $this->getField();
        }

        return $this->getRelationString().'.'.$this->getField();
    }

    // TODO: Test
    public function renderContents(Model $row): null|string|\BackedEnum|HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        if ($this->shouldCollapseOnMobile() && $this->shouldCollapseOnTablet()) {
            throw new DataTableConfigurationException('You should only specify a columns should collapse on mobile OR tablet, not both.');
        }

        return $this->getContents($row);
    }

    // TODO: Test
    public function getContents(Model $row): null|string|\BackedEnum|HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
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

    public function getSortCallback(): ?callable
    {
        return $this->sortCallback;
    }

    public function isSortable(): bool
    {
        return $this->hasField() && $this->sortable === true;
    }

    public function hasSortCallback(): bool
    {
        return $this->sortCallback !== null;
    }

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

    public function collapseOnMobile(): self
    {
        $this->collapseOnMobile = true;

        return $this;
    }

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

    public function shouldCollapseOnTablet(): bool
    {
        return $this->collapseOnTablet;
    }

    public function collapseAlways(): self
    {
        $this->collapseAlways = true;

        return $this;
    }

    public function shouldCollapseAlways(): bool
    {
        return $this->collapseAlways;
    }

    public function getSortingPillTitle(): string
    {
        if ($this->hasCustomSortingPillTitle()) {
            return $this->getCustomSortingPillTitle();
        }

        return $this->getTitle();
    }

    public function getCustomSortingPillTitle(): ?string
    {
        return $this->sortingPillTitle;
    }

    public function hasCustomSortingPillTitle(): bool
    {
        return $this->getCustomSortingPillTitle() !== null;
    }

    public function hasCustomSortingPillDirections(): bool
    {
        return $this->sortingPillDirectionAsc !== null && $this->sortingPillDirectionDesc !== null;
    }

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

    public function getSortingPillDirection(DataTableComponent $component, string $direction): string
    {
        if ($this->hasCustomSortingPillDirections()) {
            return $this->getCustomSortingPillDirections($direction);
        }

        return $direction === 'asc' ? $component->getDefaultSortingLabelAsc() : $component->getDefaultSortingLabelDesc();
    }

    public function eagerLoadRelationsIsEnabled(): bool
    {
        return $this->eagerLoadRelations === true;
    }

    public function isReorderColumn(): bool
    {
        return $this->getField() === $this->component->getDefaultReorderColumn();
    }

    public function hasFormatter(): bool
    {
        return $this->formatCallback !== null;
    }

    public function getFormatCallback(): ?callable
    {
        return $this->formatCallback;
    }

    // TODO
    public function getLabelCallback(): ?callable
    {
        return $this->labelCallback;
    }

    public function isHtml(): bool
    {
        return $this->html === true;
    }

    // TODO
    public function view(string $view): self
    {
        $this->format(function ($value, $row, Column $column) use ($view) {
            return view($view)
                ->withValue($value)
                ->withRow($row)
                ->withColumn($column);
        });

        return $this;
    }

    public function isVisible(): bool
    {
        return $this->hidden !== true;
    }

    public function isHidden(): bool
    {
        return $this->hidden === true;
    }

    public function isSelectable(): bool
    {
        return $this->selectable === true;
    }

    public function isSelected(): bool
    {
        return $this->selected === true;
    }

    public function isClickable(): bool
    {
        return $this->clickable &&
            $this->component->hasTableRowUrl() &&
            ! $this instanceof LinkColumn;
    }

    public function getCustomSlug(): string
    {
        return $this->customSlug;
    }

    public function hasCustomSlug(): bool
    {
        return $this->customSlug !== null;
    }

    public function getColumnLabelStatus(): bool
    {
        return $this->displayColumnLabel ?? true;
    }
}
