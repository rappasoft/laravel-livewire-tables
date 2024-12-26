<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;

trait ComponentHelpers
{
    public function getDataTableFingerprint(): string
    {
        return $this->dataTableFingerprint ?? ($this->dataTableFingerprint = $this->generateDataTableFingerprint());
    }

    public function hasModel(): bool
    {
        return $this->model !== null;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Get the translated empty message of the table
     */
    public function getEmptyMessage(): string
    {
        if ($this->emptyMessage == 'No items found, try to broaden your search') {
            return __($this->getLocalisationPath().'No items found, try to broaden your search');
        }

        return $this->emptyMessage;
    }

    public function getOfflineIndicatorStatus(): bool
    {
        return $this->offlineIndicatorStatus;
    }

    public function offlineIndicatorIsEnabled(): bool
    {
        return $this->getOfflineIndicatorStatus() === true;
    }

    public function offlineIndicatorIsDisabled(): bool
    {
        return $this->getOfflineIndicatorStatus() === false;
    }

    public function setTableName(string $name): string
    {
        return $this->tableName = $name;
    }

    #[Computed]
    public function getTableName(): string
    {
        return $this->tableName;
    }

    #[Computed]
    public function getTableId(): string
    {
        return $this->getTableAttributes()['id'] ?? 'table-'.$this->getTableName();
    }

    public function isTableNamed(string $name): bool
    {
        return $this->tableName === $name;
    }

    public function getComputedPropertiesStatus(): bool
    {
        return $this->useComputedProperties ?? false;
    }
}
