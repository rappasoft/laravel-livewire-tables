<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    protected ?string $customSlug = null;

    public function getSlug(): string
    {
        return Str::slug($this->hasCustomSlug() ? $this->getCustomSlug() : $this->getTitle());
    }

    public function getCustomSlug(): string
    {
        return $this->customSlug;
    }

    public function hasCustomSlug(): bool
    {
        return $this->customSlug !== null;
    }

    public function setCustomSlug(string $customSlug): self
    {
        $this->customSlug = $customSlug;

        return $this;
    }

    public function isColumnBySlug(string $slug): bool
    {
        return $this->getSlug() === $slug;
    }
}
