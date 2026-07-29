<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;

class TestLivewireColumnComponent extends Component
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
        return Blade::render(
            '<div>'.
            '<div>Name:'.($this->name ?? 'Unknown').'</div>'.
            '<div>Type:'.($this->type ?? 'Unknown').'</div>'.
            '</div>'
        );

    }
}
