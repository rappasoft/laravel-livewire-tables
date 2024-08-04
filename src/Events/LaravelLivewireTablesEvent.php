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

    public string|array|null $value;

    public ?User $user;

    public function setKeyForEvent(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    public function setValueForEvent(string|array $value): self
    {
        $this->value = $value;

        return $this;

    }

    public function setTableForEvent(string $tableName): self
    {
        $this->tableName = $tableName;

        return $this;
    }

    public function setUserForEvent(): self
    {
        if (auth()->user()) {
            $this->user = auth()->user();
        }

        return $this;
    }
}
