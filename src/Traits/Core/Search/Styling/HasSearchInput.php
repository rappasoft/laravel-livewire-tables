<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\Search\Styling;

trait HasSearchInput
{
    protected array $searchFieldAttributes = [];

    protected ?string $searchPlaceholder = null;

    protected function setSearchFieldAttributes(array $attributes = []): self
    {
        $this->setCustomAttributes('searchFieldAttributes', array_merge(['default' => false, 'default-colors' => false, 'default-styling' => false], $attributes));

        return $this;
    }

    public function getSearchFieldAttributes(): array
    {
        return $this->getCustomAttributes('searchFieldAttributes', true);
    }

    public function setSearchPlaceholder(string $placeholder): self
    {
        $this->searchPlaceholder = $placeholder;

        return $this;
    }

    public function getSearchPlaceholder(): string
    {
        if ($this->hasSearchPlaceholder()) {
            return $this->searchPlaceholder;
        }

        return __($this->getLocalisationPath().'Search');
    }

    public function hasSearchPlaceholder(): bool
    {
        return $this->searchPlaceholder !== null;
    }
}
