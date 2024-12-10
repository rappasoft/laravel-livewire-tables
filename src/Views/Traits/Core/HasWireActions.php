<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

trait HasWireActions
{
    protected bool $shouldWireNavigate = false;

    protected ?string $wireAction = null;

    protected ?string $wireActionParams = null;

    public function wireNavigate(): self
    {
        $this->shouldWireNavigate = true;

        return $this;
    }

    public function getWireNavigateEnabled(): bool
    {
        return $this->shouldWireNavigate;
    }

    public function hasWireAction(): bool
    {
        return isset($this->wireAction);
    }

    public function getWireAction(): string
    {
        return $this->wireAction;
    }

    public function setWireAction(string $wireAction): self
    {
        $this->wireAction = $wireAction;

        return $this;
    }

    public function hasWireActionParams(): bool
    {
        return isset($this->wireActionParams);
    }

    public function getWireActionParams(): string
    {
        return $this->wireActionParams;
    }

    public function setWireActionParams(string $wireActionParams): self
    {
        $this->wireActionParams = $wireActionParams;

        return $this;
    }

    public function setWireActionDispatchParams(string $wireActionParams): self
    {
        $this->setWireActionParams('$dispatch('.$wireActionParams.')');

        return $this;
    }
}
