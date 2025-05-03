<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;

trait LivewireComponentColumnHelpers
{
    /**
     * Retrieves the defined Component View
     */
    public function getLivewireComponent(): ?string
    {
        return $this->livewireComponent ?? null;
    }

    /**
     * Determines whether a Livewire Component has been set
     */
    public function hasLivewireComponent(): bool
    {
        return isset($this->livewireComponent);
    }

    /**
     * Retrieves attributes based on callback
     */
    protected function retrieveAttributes(Model $row): array
    {
        $value = $this->getValue($row);

        $attributes = ['value' => $value];

        if ($this->hasAttributesCallback()) {
            $attributes = call_user_func($this->getAttributesCallback(), $value, $row, $this);

            if (! is_array($attributes)) {
                throw new DataTableConfigurationException('The return type of callback must be an array');
            }
        }

        return $attributes;
    }

    /**
     * Runs pre-checks
     */
    protected function runPreChecks(): bool
    {
        if (! $this->hasLivewireComponent()) {
            throw new DataTableConfigurationException('You must define a Livewire Component for this column');

            return false;
        }

        if ($this->isLabel()) {
            throw new DataTableConfigurationException('You can not use a label column with a Livewire Component column');

            return false;
        }

        return true;
    }

    /**
     * Implodes defined attributes to be used
     */
    protected function implodeAttributes(array $attributes): string
    {
        return collect($attributes)->map(function ($value, $key) {
            return ':'.$key.'="$'.$key.'"';
        })->implode(' ');
    }

    /**
     * getBlade Render
     */
    protected function getBlade(array $attributes, string $key): string
    {
        return Blade::render(
            '<livewire:dynamic-component :component="$component" :key="$key" '.$this->implodeAttributes($attributes).' />',
            [
                'component' => $this->getLivewireComponent(),
                'key' => \Illuminate\Support\Str::random(),
                ...$attributes,
            ],
        );
    }

    /**
     * Gets HTML STring
     */
    protected function getHtmlString(array $attributes, string $key): HtmlString
    {
        return new HtmlString($this->getBlade($attributes, $key));

    }
}
