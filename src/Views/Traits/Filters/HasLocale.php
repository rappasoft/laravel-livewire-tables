<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Filters;

trait HasLocale
{
    public ?string $locale;

    public function setLocale(string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    public function hasLocale(): bool
    {
        return isset($this->locale);
    }

    public function getLocale(): string
    {
        return isset($this->locale) ? $this->locale : config('app.locale', 'en');
    }
}
