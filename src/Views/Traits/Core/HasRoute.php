<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

trait HasRoute
{
    public string $route = '#';

    public function route($route): self
    {
        $this->route = $route;
        $this->attributes['href'] = $route;

        return $this;
    }

    public function setRoute($route): self
    {
        $this->route = $route;
        $this->attributes['href'] = $route;

        return $this;
    }

    public function getRoute(): string
    {
        return $this->route;
    }

}