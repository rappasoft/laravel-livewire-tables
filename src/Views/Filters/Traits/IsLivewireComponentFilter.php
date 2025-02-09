<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;

trait IsLivewireComponentFilter
{
    public string $livewireComponent = '';

    public function isAnExternalLivewireFilter(): bool
    {
        return true;
    }

    public function setLivewireComponent(string $livewireComponent): self
    {

        $class = '\\'.config('livewire.class_namespace').'\\'.collect(str($livewireComponent)->explode('.'))->map(fn ($segment) => (string) str($segment)->studly())->join('\\');

        if (! class_exists($class)) {
            throw new DataTableConfigurationException('You must specify a valid path to your Livewire Component Filter.');
        }

        if (! is_subclass_of($class, \Livewire\Component::class)) {
            throw new DataTableConfigurationException('Your Livewire Component Filter MUST Extend Livewire\Component.');
        }

        $this->livewireComponent = $livewireComponent;

        return $this;
    }

    public function getLivewireComponent(): string
    {
        return $this->livewireComponent ?? '';
    }

    public function render(): string|\Illuminate\Contracts\Foundation\Application|\Illuminate\View\View|\Illuminate\View\Factory
    {
        if ($this->livewireComponent == '') {
            throw new DataTableConfigurationException('You must specify a valid path to your Livewire Component Filter.');
        }

        return view($this->getViewPath(), $this->getFilterDisplayData())->with([
            'livewireComponent' => $this->livewireComponent,
        ]);
    }
}
