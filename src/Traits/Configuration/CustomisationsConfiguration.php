<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait CustomisationsConfiguration
{
    /**
     * Used to set a Custom Layout if using a Full Page Component approach.
     */
    public function setLayout(string $layout): self
    {
        $this->layout = $layout;

        return $this;
    }

    /**
     * Used to set a Custom Slot if using a Full Page Component approach
     */
    public function setSlot(string $slot): self
    {
        $this->slot = $slot;

        return $this;
    }

    /**
     * Used to set a Custom Extends Layout if using a Full Page Component approach
     */
    public function setExtends(string $extends): self
    {
        $this->extends = $extends;

        return $this;
    }

    /**
     * Used to set a Custom Layout Section if using a Full Page Component approach
     */
    public function setSection(string $section): self
    {
        $this->section = $section;

        return $this;
    }

    /**
     * The view to add any modals for the table, could also be used for any non-visible html
     */
    public function customView(): string
    {
        return 'livewire-tables::stubs.custom';
    }
}
