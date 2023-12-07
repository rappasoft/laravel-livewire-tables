<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

trait DateColumnHelpers
{
    public function getDateFormat(): string
    {
        return $this->dateFormat ?? 'Y-m-d';
    }
}
