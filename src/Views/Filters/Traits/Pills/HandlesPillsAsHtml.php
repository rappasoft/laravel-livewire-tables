<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits\Pills;

trait HandlesPillsAsHtml
{
    protected bool $pillsAsHtml = false;

    public function getPillsAreHtml(): bool
    {
        return $this->pillsAsHtml ?? false;
    }

    public function setPillsAsHtml(bool $status = true): self
    {
        $this->pillsAsHtml = $status;

        return $this;
    }

    public function setPillsAsHtmlEnabled(): self
    {
        return $this->setPillsAsHtml(true);
    }

    public function setPillsAsHtmlDisabled(): self
    {
        return $this->setPillsAsHtml(false);
    }
}
