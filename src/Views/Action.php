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

    public function getContents(): null|string|\Illuminate\Support\HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view($this->getView())
            ->withAttributes([])
            ->withLabel($this->getLabel())
            ->withButtonAttributes($this->getActionAttributesBag())
            ->withHasWireElement($this->hasWireElement())
            ->withWireElementType($this->getWireElementType())
            ->withWireElementComponentName($this->getWireElementComponentName())
            ->withWireElementParams(json_encode($this->getWireElementParams(), true))
            ->withIcon($this->hasIcon() ? $this->getIcon() : '')
            ->withHasIcon($this->hasIcon())
            ->withIconAttributes($this->getIconAttributesBag());
    }

    public function render(): null|string|\Illuminate\Support\HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view($this->getView())
            ->withAttributes($this->getActionAttributesBag())
            ->withLabel($this->getLabel())
            ->withButtonAttributes($this->getActionAttributes())
            ->withHasWireElement($this->hasWireElement())
            ->withWireElementType($this->getWireElementType())
            ->withWireElementComponentName($this->getWireElementComponentName())
            ->withWireElementParams(json_encode($this->getWireElementParams(), true))
            ->withIcon($this->hasIcon() ? $this->getIcon() : '')
            ->withHasIcon($this->hasIcon())
            ->withIconAttributes(new \Illuminate\View\ComponentAttributeBag($this->hasIconAttributes() ? $this->getIconAttributes() : ['default' => true]));
    }
}
