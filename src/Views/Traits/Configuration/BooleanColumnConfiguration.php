<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

use Closure;

trait BooleanColumnConfiguration
{
    /**
     * @param  Closure  $callback
     *
     * @return $this
     */
    public function setCallback(Closure $callback): self
    {
        $this->callback = $callback;

        return $this;
    }

    /**
     * @param  bool  $value
     *
     * @return $this
     */
    public function setSuccessValue(bool $value): self
    {
        $this->successValue = $value;

        return $this;
    }

    /**
     * @param  string  $view
     *
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
