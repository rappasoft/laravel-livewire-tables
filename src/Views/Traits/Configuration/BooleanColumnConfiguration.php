<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

use Closure;

trait BooleanColumnConfiguration
{
    /**
     * @return $this
     */
    public function setSuccessValue(bool $value): self
    {
        $this->successValue = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function setView(string $view): self
    {
        $this->view = $view;

        return $this;
    }

    /**
     * @return $this
     */
    public function icons(): self
    {
        $this->type = 'icons';

        return $this;
    }

    /**
     * @return $this
     */
    public function yesNo()
    {
        $this->type = 'yes-no';

        return $this;
    }
}
