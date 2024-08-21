<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Views\Action;

trait WithActions
{
    public array $actionWrapperAttributes = ['default-styling' => true, 'default-colors' => true];

    public function actions(): array
    {
        return [];
    }

    public function setActionWrapperAttributes(array $actionWrapperAttributes): self
    {
        $this->actionWrapperAttributes = [...['default-styling' => true, 'default-colors' => true], ...$actionWrapperAttributes];

        return $this;
    }

    #[Computed]
    public function getActionWrapperAttributes(): array
    {
        return [...['default-styling' => true, 'default-colors' => true], ...$this->actionWrapperAttributes];
    }

    #[Computed]
    public function hasActions(): bool
    {
        return collect($this->actions())->count() > 0;
    }

    #[Computed]
    public function getActions(): Collection
    {
        $allActions = collect($this->actions());

        return $allActions->filter(fn ($action) => $action instanceof Action);
    }
}
