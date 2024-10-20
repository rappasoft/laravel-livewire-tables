<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration;

trait LoadingPlaceholderStylingConfiguration
{
    public function setLoadingPlaceHolderAttributes(array $attributes): self
    {
        $this->setCustomAttributes('loadingPlaceHolderAttributes', $attributes);

        return $this;
    }

    public function setLoadingPlaceHolderIconAttributes(array $attributes): self
    {
        $this->setCustomAttributes('loadingPlaceHolderIconAttributes', $attributes);

        return $this;
    }

    public function setLoadingPlaceHolderWrapperAttributes(array $attributes): self
    {
        $this->setCustomAttributes('loadingPlaceHolderWrapperAttributes', $attributes);

        return $this;
    }
}
