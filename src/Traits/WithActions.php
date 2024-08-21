<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Views\Action;

trait WithActions
{
    protected array $actionWrapperAttributes = ['default-styling' => true, 'default-colors' => true];

    protected function actions(): array
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
