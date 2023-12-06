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
     * Used to set a Custom Empty View
     */
    public function setCustomEmptyView(string $customEmptyView): self
    {
        $this->customEmptyView = $customEmptyView;

        return $this;
    }

    /**
     * Used to set classes for the Custom Empty View TD
     */
    public function setCustomEmptyViewClasses(string $customEmptyViewClasses): self
    {
         
         $this->customEmptyViewClasses = $customEmptyViewClasses;

         return self;
    }

}
