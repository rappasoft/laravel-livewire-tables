<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait LoadingConfiguration
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


    public function setLoadingPlaceHolderAttributes(array $attributes): self
    {
        $this->loadingPlaceHolderAttributes = $attributes;

        return $this;
    }

    public function setLoadingPlaceHolderIconAttributes(array $attributes): self
    {
        $this->loadingPlaceHolderIconAttributes = $attributes;

        return $this;
    }

}