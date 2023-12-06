<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait CustomisationsConfiguration
{
    public function setCustomEmptyView(string $customEmptyView): self
    {
        $this->customEmptyView = $customEmptyView;

        return $this;
    }
}
