<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
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
     * Determines whether a Component View has been set
     */
    public function hasLivewireComponent(): bool
    {
        return isset($this->livewireComponent);
    }

    public function getContents(Model $row): null|string|HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        if (! $this->hasLivewireComponent()) {
            throw new DataTableConfigurationException('You must define a Livewire Component for this column');
        }

        if ($this->isLabel()) {
            throw new DataTableConfigurationException('You can not use a label column with a Livewire Component column');
        }

        $attributes = [];
        $value = $this->getValue($row);

        if ($this->hasAttributesCallback()) {
            $attributes = call_user_func($this->getAttributesCallback(), $value, $row, $this);

            if (! is_array($attributes)) {
                throw new DataTableConfigurationException('The return type of callback must be an array');
            }
        }

        $implodedAttributes = collect($attributes)->map(function ($value, $key) {
            return ':'.$key.'="$'.$key.'"';
        })->implode(' ');

        return new HtmlString(Blade::render(
            '<livewire:dynamic-component :component="$component" '.$implodedAttributes.' :wire:key="'.$row->{$row->getKeyName()}.'" />',
            [
                'component' => $this->getLivewireComponent(),
                ...$attributes,
            ],
        ));

    }
}
