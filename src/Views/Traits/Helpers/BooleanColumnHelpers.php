<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

use Closure;

trait BooleanColumnHelpers
{
    /**
     * @return bool
     */
    public function hasCallback(): bool
    {
        return $this->callback !== null;
    }

    /**
     * @return Closure
     */
    public function getCallback(): Closure
    {
        return $this->callback;
    }

    /**
     * @return bool
     */
    public function getSuccessValue(): bool
    {
        return $this->successValue;
    }

    /**
     * @return string
     */
    public function getView(): string
    {
        return $this->view;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
