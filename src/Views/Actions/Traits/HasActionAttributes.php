<?php

namespace Rappasoft\LaravelLivewireTables\Views\Actions\Traits;

use Illuminate\View\ComponentAttributeBag;

trait HasActionAttributes
{
    protected array $actionAttributes = ['class' => '', 'default-styling' => true, 'default-colors' => true];

    public function setActionAttributes(array $actionAttributes): self
    {
        $this->actionAttributes = [...$this->actionAttributes, ...$actionAttributes];

        return $this;
    }

    public function getActionAttributes(): ComponentAttributeBag
    {
        $actionAttributes = [...['class' => '', 'default-styling' => true, 'default-colors' => true], ...$this->actionAttributes];

        if (! $this->hasWireAction() && method_exists($this, 'getRoute')) {
            $actionAttributes['href'] = $this->getRoute();
        } else {
            $actionAttributes['href'] = '#';
        }

        return new ComponentAttributeBag($actionAttributes);
    }
}
