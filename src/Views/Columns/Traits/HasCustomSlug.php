<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits;

trait HasCustomSlug
{
    protected ?string $customSlug = null;

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


}