<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait CustomisationsHelpers
{
    /**
     * Used to determine if a Layout Extends has been defined - used when using as a Full Page Component
     */
    public function hasExtends(): bool
    {
        return isset($this->extends);
    }

    public function getExtends(): ?string
    {
        return $this->extends;
    }

    /**
     * Used to determine if a Layout Section has been defined - used when using as a Full Page Component
     */
    public function hasSection(): bool
    {
        return isset($this->section);
    }

    public function getSection(): ?string
    {
        return $this->section;
    }

    /**
     * Used to determine if a Layout Slot has been defined - used when using as a Full Page Component
     */
    public function hasSlot(): bool
    {
        return isset($this->slot);
    }

    public function getSlot(): ?string
    {
        return $this->slot;
    }

    /**
     * Used to determine if a $layout has been defined - used when using as a Full Page Component
     */
    public function hasLayout(): bool
    {
        return isset($this->layout);
    }

    public function getLayout(): ?string
    {
        return $this->layout;
    }
}
