<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;

trait ComponentHelpers
{
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

    #[Computed]
    public function getTableId(): string
    {
        return $this->getTableAttributes()['id'] ?? 'table-'.$this->getTableName();
    }
}
