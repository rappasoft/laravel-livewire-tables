<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\ActionsConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\ActionsHelpers;
use Rappasoft\LaravelLivewireTables\Traits\Styling\HasActionsStyling;

trait WithActions
{
    use ActionsConfiguration,
        ActionsHelpers,
        HasActionsStyling;

    protected bool $displayActionsInToolbar = false;

    protected string $actionsPosition = 'right';

    protected ?Collection $validActions;

    protected function actions(): array
    {
        return [];
    }
}
