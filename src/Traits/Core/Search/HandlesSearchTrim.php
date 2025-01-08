<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\Search;

trait HandlesSearchTrim
{
    protected bool $trimSearchString = false;

    public function shouldTrimSearchString(): bool
    {
        return $this->trimSearchString ?? false;
    }

    public function setTrimSearchString(bool $status): self
    {
        $this->trimSearchString = $status;

        return $this;
    }

    public function setTrimSearchStringEnabled(): self
    {
        $this->setTrimSearchString(true);

        return $this;
    }

    public function setTrimSearchStringDisabled(): self
    {
        $this->setTrimSearchString(false);

        return $this;
    }
}
