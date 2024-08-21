<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Views\Action;

trait WithActions
{
    protected const DEFAULT_ACTION_WRAPPER_ATTRIBUTES = ['default-styling' => true, 'default-colors' => true];

    protected array $actionWrapperAttributes = ['default-styling' => true, 'default-colors' => true];

    protected function actions(): array
    {
        return [];
    }

    public function setActionWrapperAttributes(array $actionWrapperAttributes): self
    {
        $this->actionWrapperAttributes = [...self::DEFAULT_ACTION_WRAPPER_ATTRIBUTES, ...$actionWrapperAttributes];

        return $this;
    }

    #[Computed]
    public function getActionWrapperAttributes(): array
    {
        return [...self::DEFAULT_ACTION_WRAPPER_ATTRIBUTES, ...$this->actionWrapperAttributes];
    }

    #[Computed]
    public function hasActions(): bool
    {
        return $this->getActions()->count() > 0;
    }

    #[Computed]
    public function getActions(): Collection
    {
        return (new Collection($this->actions()))->filter(fn ($action) => $action instanceof Action);
    }
}
