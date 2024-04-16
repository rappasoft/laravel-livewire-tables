<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

trait HasWireables
{
    public function setWireDebounce(int $debouncePeriod): self
    {
        $this->wireMethod = 'live.debounce.'.$debouncePeriod.'ms';

        return $this;
    }

    public function setWireBlur(): self
    {
        $this->wireMethod = 'blur';

        return $this;
    }

    public function setWireDefer(): self
    {
        $this->wireMethod = 'defer';

        return $this;
    }

    public function setWireLive(): self
    {
        $this->wireMethod = 'live';

        return $this;
    }

    public function setWireMethod(string $wireMethod): self
    {
        $this->wireMethod = $wireMethod;

        return $this;
    }

    public function getWireMethod(string $wireableElement): string
    {
        return $this->getWireMethodString($this->wireMethod ?? 'blur', $wireableElement);
    }

    public function getWireMethodString(string $wireMethod, string $wireableElement): string
    {

        if ($wireMethod != 'defer') {
            return 'wire:model.'.$wireMethod.'='.$wireableElement;
        }

        return 'wire:model='.$wireableElement;

    }

    public function getWireMethodAppends(): int
    {
        return $this->wireMethodAppends;
    }
}
