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

    public function setLoadingPlaceHolderWrapperAttributes(array $attributes): self
    {
        $this->loadingPlaceHolderTrAttributes = array_merge(['default' => true], $attributes);

        return $this;
    }

    public function setLoadingPlaceholderBlade(string $customBlade): self
    {
        $this->loadingPlaceholderBlade = $customBlade;

        return $this;
    }


    public function setLoadingPlaceHolderTrAttributes(array $attributes): self
    {
        $this->loadingPlaceHolderTrAttributes = array_merge(['default' => true], $attributes);

        return $this;
    }


    public function setLoadingPlaceHolderTdAttributes(array $attributes): self
    {
        $this->loadingPlaceHolderTdAttributes = array_merge(['default' => true], $attributes);

        return $this;
    }

    public function setLoadingPlaceholderContentBlade(string $customBlade): self
    {
        $this->loadingPlaceholderContentBlade = $customBlade;

        return $this;
    }

}
