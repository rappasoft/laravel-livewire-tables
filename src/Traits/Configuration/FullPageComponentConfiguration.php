<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait FullPageComponentConfiguration
{
    
    public function setLayout(string $layout): self
    {
        $this->layout = $layout;

        return $this;
    }

    public function setSlot(string $slot): self
    {
        $this->slot = $slot;

        return $this;
    }

    public function setExtends(string $layout): self
    {
        $this->extends = $layout;

        return $this;
    }

    public function setSection(string $section): self
    {
        $this->section = $section;

        return $this;
    }

}