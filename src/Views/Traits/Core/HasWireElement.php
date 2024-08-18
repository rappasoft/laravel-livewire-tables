<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Illuminate\Database\Eloquent\Model;

trait HasWireElement
{
    protected ?string $wireElementType = null;

    protected ?string $wireElementComponentName = null;

    protected array $wireElementParams = [];

    protected ?object $wireElementCallback;

    protected bool $shouldWireNavigate = false;

    public function wireModal($component, $params = []): self
    {
        $this->wireElementType = 'modal';
        $this->wireElementComponentName = $component;
        $this->wireElementParams = $params;

        return $this;
    }

    public function wireSlideOver($component, $params = []): self
    {
        $this->wireElementType = 'slide-over';
        $this->wireElementComponentName = $component;
        $this->wireElementParams = $params;

        return $this;
    }

    public function wireElement(callable $callback): self
    {
        $this->wireElementCallback = $callback;

        return $this;
    }

    public function getWireElementCallback(): ?callable
    {
        return $this->wireElementCallback;
    }

    public function hasWireElementCallback(): bool
    {
        return isset($this->wireElementCallback) && $this->wireElementCallback !== null;
    }

    public function setWireElement(Model $row): void
    {
        $wireElement = $this->hasWireElementCallback() ? app()->call($this->getWireElementCallback(), ['row' => $row]) : [];
        $this->wireElementType = $wireElement['type'] ?? null;
        $this->wireElementComponentName = $wireElement['component'] ?? null;
        $this->wireElementParams = $wireElement['params'] ?? [];
    }

    public function hasWireElement(): bool
    {
        return $this->wireElementComponentName !== null;
    }

    public function getWireElementComponentName(): ?string
    {
        return $this->wireElementComponentName;
    }

    public function getWireElementType(): ?string
    {
        return $this->wireElementType;
    }

    public function getWireElementParams(): array
    {
        return $this->wireElementParams;
    }

    public function setWireElementParams($params): self
    {
        $this->wireElementParams = $params;

        return $this;
    }

    public function wireNavigate(): self
    {
        $this->shouldWireNavigate = true;

        return $this;
    }

    public function getWireNavigate(): bool
    {
        return $this->shouldWireNavigate;
    }

    protected function getWireElementView(): array
    {
        return [
            'shouldWireNavigate' => $this->getWireNavigate(),
            'hasWireElement' => $this->hasWireElement(),
            'wireElementType' => $this->getWireElementType(),
            'wireElementComponentName' => $this->getWireElementComponentName(),
            'wireElementParams' => json_encode($this->getWireElementParams(), true),
        ];
    }
}
