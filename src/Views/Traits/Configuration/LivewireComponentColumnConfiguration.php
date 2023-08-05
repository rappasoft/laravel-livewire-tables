<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

trait LivewireComponentColumnConfiguration
{
    use ComponentColumnConfiguration;

    protected string $componentView;

    protected callable $attributesCallback;

    protected callable $slotCallback;
}
