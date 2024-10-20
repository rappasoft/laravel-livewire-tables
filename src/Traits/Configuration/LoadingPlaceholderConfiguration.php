<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait LoadingPlaceholderConfiguration
{
    public function setLoadingPlaceholderStatus(bool $status): self
    {
        $this->displayLoadingPlaceholder = $status;

        return $this;
    }

    public function setLoadingPlaceholderEnabled(): self
    {
        $this->setLoadingPlaceholderStatus(true);

        return $this;
    }

    public function setLoadingPlaceholderDisabled(): self
    {
        $this->setLoadingPlaceholderStatus(false);

        return $this;
    }

    public function setLoadingPlaceholderContent(string $content): self
    {
        $this->loadingPlaceholderContent = $content;

        return $this;
    }

    public function setLoadingPlaceholderBlade(string $customBlade): self
    {
        $this->loadingPlaceholderBlade = $customBlade;

        return $this;
    }
}
