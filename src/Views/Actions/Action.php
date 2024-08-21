<?php

namespace Rappasoft\LaravelLivewireTables\Views\Actions;

use Rappasoft\LaravelLivewireTables\Views\Action as BaseAction;

class Action extends BaseAction
{
    public function __construct(?string $label = null)
    {
        parent::__construct($label);
    }
}
