<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

trait ColorColumnConfiguration
{
    /**
     * Retrieve the Custom Classes to use for the Column
     */
    public function setCustomClasses(string $customClasses, bool $append = false): self
    {
        $this->customClasses = ['class' => $customClasses, 'default' => $append];

       // $this->customClasses = ($append) ? $customClasses . ' ' . $this->customClasses . ' ' . $customClasses : $customClasses;

        return $this;
    }

    public function color(callable $callback): self
    {
        $this->colorCallback = $callback;

        return $this;
    }

}
