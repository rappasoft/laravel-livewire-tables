<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Actions;

use Illuminate\View\ComponentAttributeBag;

trait HasActionAttributes
{
    protected const DEFAULT_ACTION_ATTRIBUTES = ['default-styling' => true, 'default-colors' => true];

    protected array $actionAttributes = ['default-styling' => true, 'default-colors' => true];

    public function setActionAttributes(array $actionAttributes): self
    {
        $this->actionAttributes = [...self::DEFAULT_ACTION_ATTRIBUTES, ...$actionAttributes];

        return $this;
    }

    public function getActionAttributes(): ComponentAttributeBag
    {
        $actionAttributes = [...self::DEFAULT_ACTION_ATTRIBUTES, ...$this->actionAttributes];

        if (! $this->hasWireAction() && method_exists($this, 'getRoute')) {
            $actionAttributes['href'] = $this->getRoute();
        } else {
            $actionAttributes['href'] = '#';
        }

        return new ComponentAttributeBag($actionAttributes);
    }
}
