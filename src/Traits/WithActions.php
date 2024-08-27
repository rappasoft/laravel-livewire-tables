<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\ActionsConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\ActionsHelpers;

trait WithActions
{
    use ActionsConfiguration,
        ActionsHelpers;

    protected array $actionWrapperAttributes = ['class' => '', 'default-styling' => true, 'default-colors' => true];

    protected bool $displayActionsInToolbar = false;

    protected string $actionsPosition = 'right';

    protected ?Collection $validActions;

    protected function actions(): array
    {
        return [];
    }
}
