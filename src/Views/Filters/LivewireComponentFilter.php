<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class LivewireComponentFilter extends Filter
{
    protected string $view = 'livewire-tables::components.tools.filters.livewire-component-filter';

    public string $livewireComponent = '';

    public function validate(string $value): string|bool
    {
        return $value;
    }

    public function isEmpty(?string $value): bool
    {
        return is_null($value) || $value === '';
    }

    /**
     * Gets the Default Value for this Filter via the Component
     */
    public function getFilterDefaultValue(): ?string
    {
        return $this->filterDefaultValue ?? null;
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
