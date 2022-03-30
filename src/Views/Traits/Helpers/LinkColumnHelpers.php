<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

trait LinkColumnHelpers
{
    // TODO: Test
    public function getTitleCallback()
    {
        return $this->titleCallback;
    }

    public function hasTitleCallback()
    {
        return $this->titleCallback !== null;
    }

    public function getLocationCallback()
    {
        return $this->locationCallback;
    }

    public function hasLocationCallback()
    {
        return $this->locationCallback !== null;
    }

    public function getAttributesCallback()
    {
        return $this->attributesCallback;
    }

    public function hasAttributesCallback()
    {
        return $this->attributesCallback !== null;
    }

    public function getView(): string
    {
        return $this->view;
    }
}
