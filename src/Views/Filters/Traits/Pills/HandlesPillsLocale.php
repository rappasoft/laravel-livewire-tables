<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits\Pills;

trait HandlesPillsLocale
{
    protected ?string $pillsLocale;

    public function setPillsLocale(string $pillsLocale): self
    {
        $this->pillsLocale = $pillsLocale;

        return $this;
    }

    public function hasPillsLocale(): bool
    {
        return isset($this->pillsLocale);
    }

    public function getPillsLocale(): string
    {
        return isset($this->pillsLocale) ? $this->pillsLocale : ($this->getConfig('locale') ?? config('app.locale', 'en'));
    }
}
