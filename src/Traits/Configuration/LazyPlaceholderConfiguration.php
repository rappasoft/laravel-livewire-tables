<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait LazyPlaceholderConfiguration
{
    public function setLazyPlaceholderStatus(bool $status): self
    {
        $this->lazyPlaceholderEnabled = $status;

        return $this;
    }

    public function setLazyPlaceholderEnabled(): self
    {
        $this->setLazyPlaceholderStatus(true);

        return $this;
    }

    public function setLazyPlaceholderDisabled(): self
    {
        $this->setLazyPlaceholderStatus(false);

        return $this;
    }

    public function setLazyPlaceholderView(string $view): self
    {
        $this->lazyPlaceholderView = $view;

        return $this;
    }
}
