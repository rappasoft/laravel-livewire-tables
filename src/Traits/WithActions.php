<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;

trait WithActions
{
    public array $actionWrapperAttributes = ['default' => true];

    public function setActionWrapperAttributes(array $actionWrapperAttributes)
    {
        $this->actionWrapperAttributes = [...['default' => true], ...$actionWrapperAttributes];
    }

    #[Computed]
    public function getActionWrapperAttributes()
    {
        return $this->actionWrapperAttributes ?? ['default' => true];
    }

    public function actions(): array
    {
        return [];
    }

    #[Computed]
    public function hasActions(): bool
    {
        return collect($this->actions())->count() > 0;
    }

    #[Computed]
    public function getActions(): Collection
    {
        return collect($this->actions());
    }

}