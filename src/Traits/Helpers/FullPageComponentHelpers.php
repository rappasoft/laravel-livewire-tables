<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait FullPageComponentHelpers
{
    public function hasExtends()
    {
        return $this->extends !== null;
    }

    public function getExtends()
    {
        return $this->extends;
    }

    public function hasSection()
    {
        return $this->section !== null;
    }

    public function getSection()
    {
        return $this->section;
    }

    public function hasSlot()
    {
        return $this->slot !== null;
    }

    public function getSlot()
    {
        return $this->slot;
    }

    public function hasLayout()
    {
        return $this->layout !== null;
    }

    public function getLayout()
    {
        return $this->layout;
    }
}
