<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Closure;

trait UsesValidation
{
    public bool $validationEnabled = true;

    public ?Closure $validationCallback = null;

    public function getValidationStatus(): bool
    {
        return $this->validationEnabled;
    }

    public function isValidationEnabled(): bool
    {
        return $this->getValidationStatus();
    }

    public function setValidation(bool $validationEnabled): self
    {
        $this->validationEnabled = $validationEnabled;

        return $this;
    }

    public function setValidationEnabled(): self
    {
        $this->setValidation(true);

        return $this;
    }

    public function setValidationDisabled(): self
    {
        $this->setValidation(false);

        return $this;
    }

    /**
     * @return $this
     */
    public function validation(Closure $validationCallback): self
    {
        $this->validationCallback = $validationCallback;

        return $this;
    }

    public function hasValidationCallback(): bool
    {
        return $this->validationCallback !== null;
    }

    public function getValidationCallback(): Closure
    {
        return $this->validationCallback;
    }
}
