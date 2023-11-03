<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

use Illuminate\Database\Eloquent\Builder;

trait ComponentConfiguration
{
    public function setPrimaryKey(?string $key): self
    {
        $this->primaryKey = $key;

        return $this;
    }

    /**
     * Set the empty message
     */
    public function setEmptyMessage(string $message): self
    {
        $this->emptyMessage = $message;

        return $this;
    }

    public function setOfflineIndicatorStatus(bool $status): self
    {
        $this->offlineIndicatorStatus = $status;

        return $this;
    }

    public function setOfflineIndicatorEnabled(): self
    {
        $this->setOfflineIndicatorStatus(true);

        return $this;
    }

    public function setOfflineIndicatorDisabled(): self
    {
        $this->setOfflineIndicatorStatus(false);

        return $this;
    }

    public function setEagerLoadAllRelationsStatus(bool $status): self
    {
        $this->eagerLoadAllRelationsStatus = $status;

        return $this;
    }

    public function setEagerLoadAllRelationsEnabled(): self
    {
        $this->setEagerLoadAllRelationsStatus(true);

        return $this;
    }

    public function setEagerLoadAllRelationsDisabled(): self
    {
        $this->setEagerLoadAllRelationsStatus(false);

        return $this;
    }

    public function setAdditionalSelects(string|array $selects): self
    {
        if (! is_array($selects)) {
            $selects = [$selects];
        }

        $this->additionalSelects = $selects;

        return $this;
    }

    public function setDataTableFingerprint(string $dataTableFingerprint): self
    {
        $this->dataTableFingerprint = $dataTableFingerprint;

        return $this;
    }

    /**
     * Returns a unique id for the table, used as an alias to identify one table from another session and query string to prevent conflicts
     */
    protected function generateDataTableFingerprint(): string
    {
        $className = str_split(static::class);
        $crc32 = sprintf('%u', crc32(serialize($className)));

        return base_convert($crc32, 10, 36);
    }

    public function setBuilder(Builder $builder): void
    {
        $this->builder = $builder;
    }

    public function setTheme(): void
    {
        $theme = $this->getTheme();

        if ($theme === 'bootstrap-4' || $theme === 'bootstrap-5') {
            $this->setPaginationTheme('bootstrap');
        }
    }

    public function setTableName(string $name): self
    {
        $this->tableName = $name;

        return $this;

    }
}
