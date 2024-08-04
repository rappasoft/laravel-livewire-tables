<?php

namespace Rappasoft\LaravelLivewireTables\Events;

use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LaravelLivewireTablesEvent
{
    use Dispatchable, SerializesModels;

    public string $tableName;

    public ?string $key;

    public ?User $user;

    public string|array $value;

    public function setupCoreEventProperties(string $tableName, string $key)
    {
        $this->setTableForEvent($tableName);

        $this->key = $key;

    }

    public function setValueForEvent(string $value)
    {
        $this->value = $value;
    }

    public function setTableForEvent(string $tableName)
    {
        $this->tableName = $tableName;

        $this->setupUserForEvent();

    }

    public function setupUserForEvent()
    {
        if (auth()->user()) {
            $this->user = auth()->user();
        }
    }
}
