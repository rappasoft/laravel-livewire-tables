<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait CustomisationsConfiguration
{

    /**
     * Used to set a Custom Layout if using a Full Page Component approach
     * 
     * @param string $layout
     * 
     * @return self
     */
    public function setLayout(string $layout): self
    {
        $this->layout = $layout;

        return $this;
    }

    /**
     * Used to set a Custom Slot if using a Full Page Component approach
     * 
     * @param string $slot
     * 
     * @return self
     */
    public function setSlot(string $slot): self
    {
        $this->slot = $slot;

        return $this;
    }

    /**
     * Used to set a Custom Extends Layout if using a Full Page Component approach
     * 
     * @param string $layout
     * 
     * @return self
     */
    public function setExtends(string $layout): self
    {
        $this->extends = $layout;

        return $this;
    }

    /**
     * Used to set a Custom Layout Section if using a Full Page Component approach
     * 
     * @param string $layout
     * 
     * @return self
     */
    public function setSection(string $section): self
    {
        $this->section = $section;

        return $this;
    }

}
