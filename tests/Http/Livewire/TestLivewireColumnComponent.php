<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

class TestLivewireColumnComponent extends \Livewire\Component
{
    public string $id;

    public string $name;

    public string $value;

    public string $type;

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return \Illuminate\Support\Facades\Blade::render(
            '<div>'.
            '<div>Name:'.($this->name ?? 'Unknown').'</div>'.
            '<div>Type:'.($this->type ?? 'Unknown').'</div>'.
            '</div>'
        );

    }
}
