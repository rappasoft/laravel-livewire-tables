<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

trait HasWireables
{
    protected function checkWireMethod(string $wireMethod): string
    {
        if ($wireMethod == 'wireMethod' || $wireMethod == 'searchMethod') {
            return $wireMethod;
        }

        return 'wireMethod';
    }

    public function setWireDebounce(int $debouncePeriod = 500, string $wireMethod = 'wireMethod'): self
    {
        $wireMethod = $this->checkWireMethod($wireMethod);

        $this->{$wireMethod} = 'live.debounce.'.$debouncePeriod.'ms';

        return $this;
    }

    public function setWireBlur(string $wireMethod = 'wireMethod'): self
    {
        $wireMethod = $this->checkWireMethod($wireMethod);

        $this->{$wireMethod} = 'blur';

        return $this;
    }

    public function setWireDefer(string $wireMethod = 'wireMethod'): self
    {
        $wireMethod = $this->checkWireMethod($wireMethod);

        $this->{$wireMethod} = 'defer';

        return $this;
    }

    public function setWireLive(string $wireMethod = 'wireMethod'): self
    {
        $wireMethod = $this->checkWireMethod($wireMethod);

        $this->{$wireMethod} = 'live';

        return $this;
    }

    public function setWireMethod(string $definedWireMethod, string $wireMethod = 'wireMethod'): self
    {
        $wireMethod = $this->checkWireMethod($wireMethod);

        $this->{$wireMethod} = $definedWireMethod;

        return $this;
    }

    public function getWireableMethod(string $wireMethod = 'wireMethod'): string
    {
        $wireMethod = $this->checkWireMethod($wireMethod);

        return $this->{$wireMethod};
    }

    public function getWireMethod(string $wireableElement, string $wireMethod = 'wireMethod'): string
    {
        $wireMethod = $this->checkWireMethod($wireMethod);

        return $this->getWireMethodString($this->{$wireMethod} ?? 'blur', $wireableElement);
    }

    public function getWireMethodString(string $wireMethod, string $wireableElement): string
    {

        if ($wireMethod != 'defer') {
            return 'wire:model.'.$wireMethod.'='.$wireableElement;
        }

        return 'wire:model='.$wireableElement;

    }
}
