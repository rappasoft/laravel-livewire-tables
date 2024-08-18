<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Illuminate\View\ComponentAttributeBag;

trait HasActionAttributes
{
    protected array $actionAttributes = ['default' => true];

    public function setActionAttributes(array $actionAttributes): static
    {
        $this->actionAttributes = [...['default' => true], ...$actionAttributes];

        return $this;
    }

    public function getActionAttributes(): array
    {
        return array_merge(['default' => true], $this->actionAttributes);
    }

    public function getActionAttributesBag(): ComponentAttributeBag
    {
        $actionAttributes['href'] = $this->getRoute();
        return new \Illuminate\View\ComponentAttributeBag($actionAttributes);

    }
}