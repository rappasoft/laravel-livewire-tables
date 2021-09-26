<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

/**
 * Trait WithFooter.
 */
trait WithFooter
{
    public bool $useHeaderAsFooter = false;
    public bool $customFooter = false;

    public function mountWithFooter(): void
    {
        foreach ($this->columns() as $column) {
            if ($column->hasFooter()) {
                $this->customFooter = true;
            }
        }
    }
}
