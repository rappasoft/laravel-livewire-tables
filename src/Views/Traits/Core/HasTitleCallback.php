<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Closure;
use Rappasoft\LaravelLivewireTables\Views\{Column,Filter};

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
