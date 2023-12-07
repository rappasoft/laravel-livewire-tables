<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

trait DateColumnHelpers
{
    public function getToFormat(): string
    {
        return $this->toFormat ?? 'Y-m-d';
    }

    public function getFromFormat(): ?string
    {
        return $this->fromFormat ?? null;
    }
}
