<?php

namespace Rappasoft\LaravelLivewireTables\Views;

use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;
use Rappasoft\LaravelLivewireTables\Views\Traits\Columns\HasVisibility;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\{HasActionAttributes, HasIcon, HasLabel, HasRoute, HasView, HasWireElement};

class Action extends Component
{
    use HasActionAttributes;
    use HasIcon;
    use HasLabel;
    use HasRoute;
    use HasView;
    use HasVisibility;
    use HasWireElement;

    protected string $view = 'livewire-tables::includes.actions.button';

    public function __construct(?string $label = null)
    {
        $this->label = trim(__($label));
    }

    public static function make(?string $label = null): self
    {
        return new static($label);
    }

    public function render(): null|string|\Illuminate\Support\HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $view = view($this->getView())
            ->withAttributes($this->getActionAttributesBag())
            ->withLabel($this->getLabel())
            ->withButtonAttributes($this->getActionAttributes())
            ->with([
                ...$this->getWireElementView(),
                ...$this->getIconView(),
            ]);


        return $view;
    }
}
