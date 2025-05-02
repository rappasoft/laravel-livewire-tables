<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TestComponent extends Component
{
    public int $testItem = 0;

    public function __construct(int $age)
    {
        $this->testItem = $age * 110;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return \Illuminate\Support\Facades\Blade::render(
            '<div>'.($this->testItem ?? 'Unknown').'</div>');

    }
}
