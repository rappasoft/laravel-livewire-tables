<?php

namespace Rappasoft\LaravelLivewireTables\Views\Actions\Traits;

trait HasRoute
{
    public string $route = '#';

    public function route(string $route): self
    {
        $this->route = $route;
        $this->attributes['href'] = $route;

        return $this;
    }

    public function setRoute(string $route): self
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
