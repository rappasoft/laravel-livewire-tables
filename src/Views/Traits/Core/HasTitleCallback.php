<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

trait HasTitleCallback
{
    protected mixed $titleCallback = null;

    // TODO: Test
    public function title(callable $callback): self
    {
        $this->titleCallback = $callback;

        return $this;
    }

    // TODO: Test
    public function getTitleCallback(): ?callable
    {
        return $this->titleCallback;
    }

    public function hasTitleCallback(): bool
    {
        return $this->titleCallback !== null;
    }
}
