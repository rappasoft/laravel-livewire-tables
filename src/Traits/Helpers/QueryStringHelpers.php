<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait QueryStringHelpers
{
    public function hasQueryStringStatus(): bool
    {
        return isset($this->queryStringStatus);
    }

    public function getQueryStringStatus(): bool
    {
        return $this->queryStringStatus ?? true;
    }

    public function queryStringIsEnabled(): bool
    {
        $this->setupQueryStringStatus();

        return $this->getQueryStringStatus() === true;
    }

    public function queryStringIsDisabled(): bool
    {
        return $this->getQueryStringStatus() === false;
    }

    public function hasQueryStringAlias(): bool
    {
        return isset($this->queryStringAlias);
    }

    public function getQueryStringAlias(): string
    {
        return $this->queryStringAlias ?? $this->getTableName();
    }
}
