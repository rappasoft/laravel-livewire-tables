<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

trait LinkColumnHelpers
{
    // TODO: Test
    public function getTitleCallback(): ?callable
    {
        return $this->titleCallback;
    }

    public function hasTitleCallback(): bool
    {
        return $this->titleCallback !== null;
    }
}
