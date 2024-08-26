<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Views\Action;

trait ActionsHelpers
{
    #[Computed]
    public function showActionsInToolbar(): bool
    {
        return $this->displayActionsInToolbar ?? false;
    }

    #[Computed]
    public function getActionsPosition(): string
    {
        return $this->actionsPosition ?? 'right';
    }

    #[Computed]
    public function getActionWrapperAttributes(): array
    {
        return [...['class' => '', 'default-styling' => true, 'default-colors' => true], ...$this->actionWrapperAttributes];
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
            ->each(function (Action $action) {
                $action->setTheme($this->getTheme());
            });

    }
}
