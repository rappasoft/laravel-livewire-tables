<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait CustomisationsHelpers
{
    public function getCustomEmptyView(): string
    {
        return $this->customEmptyView ?? '';
    }

}
