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
