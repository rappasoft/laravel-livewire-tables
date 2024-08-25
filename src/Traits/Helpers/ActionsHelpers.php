<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Livewire\Attributes\Computed;
use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Views\Action;

trait ActionsHelpers
{

    #[Computed]
    public function showActionsInToolbar(): bool
    {
        return $this->displayActionsInToolbar ?? false;
    }

    #[Computed]
    public function showActionsInToolbar(): bool
    {
        return $this->displayActionsInToolbar ?? false;
    }

    #[Computed]
    public function getActionWrapperAttributes(): array
    {
        return [...['default-styling' => true, 'default-colors' => true], ...$this->actionWrapperAttributes];
    }

    #[Computed]
    public function hasActions(): bool
    {
        return (new Collection($this->actions()))
            ->filter(fn ($action) => $action instanceof Action)->count() > 0;
    }

    #[Computed]
    public function getActions(): Collection
    {
        return (new Collection($this->actions()))
            ->filter(fn ($action) => $action instanceof Action)
            ->each(function (Action $action, int $key) {
                $action->setTheme($this->getTheme());
            });

    }
}