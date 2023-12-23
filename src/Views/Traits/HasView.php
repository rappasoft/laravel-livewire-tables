<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits;

use Rappasoft\LaravelLivewireTables\Views\{Column,Filter};

trait HasView
{
    public function getView(): string
    {
        return $this->view;
    }

    /**
     * @return $this
     */
    public function setView(string $view): self
    {
        $this->view = $view;

        return $this;
    }

    public function setCustomView(string $customView): self
    {
        $this->view = $customView;

        return $this;
    }

    public function getViewPath(): string
    {
        return $this->view;
    }
}
