<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Views\Column;

trait ColumnSelectConfiguration
{
    public function setColumnSelectStatus(bool $status): self
    {
        $this->columnSelectStatus = $status;

        return $this;
    }

    public function setColumnSelectEnabled(): self
    {
        $this->setColumnSelectStatus(true);

        return $this;
    }

    public function setColumnSelectDisabled(): self
    {
        $this->setColumnSelectStatus(false);

        return $this;
    }

    public function setRememberColumnSelectionStatus(bool $status): self
    {
        $this->rememberColumnSelectionStatus = $status;

        return $this;
    }

    public function setRememberColumnSelectionEnabled(): self
    {
        $this->setRememberColumnSelectionStatus(true);

        return $this;
    }

    public function setRememberColumnSelectionDisabled(): self
    {
        $this->setRememberColumnSelectionStatus(false);

        return $this;
    }

    public function setExcludeDeselectedColumnsFromQueryEnabled(): self
    {
        $this->setExcludeDeselectedColumnsFromQuery(true);

        return $this;
    }

    public function setExcludeDeselectedColumnsFromQueryDisabled(): self
    {
        $this->setExcludeDeselectedColumnsFromQuery(false);

        return $this;
    }

    public function setExcludeDeselectedColumnsFromQuery(bool $status): self
    {
        $this->excludeDeselectedColumnsFromQuery = $status;

        return $this;
    }

    public function setColumnSelectHiddenOnMobile(): self
    {
        $this->columnSelectHiddenOnMobile = true;

        return $this;
    }

    public function setColumnSelectHiddenOnTablet(): self
    {
        $this->columnSelectHiddenOnTablet = true;

        return $this;
    }

    public function setDefaultDeselectedColumns(): array
    {
        return collect($this->getColumns()
            ->reject(fn (Column $column) => ! $column->isSelectable())
            ->reject(fn (Column $column) => $column->isSelectable() && $column->isSelected())
        )
            ->keyBy(function (Column $column, int $key) {
                return $column->getSlug();
            })
            ->map(fn ($column) => $column->getTitle())
            ->toArray();
    }
}
