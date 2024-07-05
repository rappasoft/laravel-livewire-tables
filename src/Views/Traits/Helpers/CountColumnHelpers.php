<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\ComponentAttributeBag;

trait CountColumnHelpers
{
    public function getCountSource(): string
    {
        
        return $this->countSource;
    }

    public function hasCountSource():bool
    {
        return isset($this->countSource);
    }

}
