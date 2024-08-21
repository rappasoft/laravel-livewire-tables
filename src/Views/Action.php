<?php

namespace Rappasoft\LaravelLivewireTables\Views;

use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;
use Rappasoft\LaravelLivewireTables\Views\Traits\Columns\HasVisibility;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\{HasIcon, HasLabel, HasView, HasWireActions};
use Rappasoft\LaravelLivewireTables\Views\Traits\Actions\{HasActionAttributes, HasRoute};

class Action extends Component
{
    use HasActionAttributes;
    use HasIcon;
    use HasLabel;
    use HasRoute;
    use HasView;
    use HasVisibility;
    use HasWireActions;

    protected string $view = 'livewire-tables::includes.actions.button';

    public function __construct(?string $label = null)
    {
        $this->label = trim(__($label));
    }

    public static function make(?string $label = null): self
    {
        return new static($label);
    }

    public function render(): null|string|\Illuminate\Support\HtmlString|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $view = view($this->getView())
            ->withAction($this)
            ->withAttributes($this->getActionAttributes());

        return $view;
    }
}
