<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

use Rappasoft\LaravelLivewireTables\Views\Filters\Traits\Pills\{HandlesPillsAsHtml,HandlesPillsCustomBlade,HandlesPillsLocale};
use Rappasoft\LaravelLivewireTables\Views\Filters\Traits\Styling\HandlesFilterPillsAttributes;

trait HasFilterPills
{
    use HandlesPillsAsHtml,
        HandlesPillsCustomBlade,
        HandlesPillsLocale,
        HandlesFilterPillsAttributes;

    protected ?string $filterPillTitle = null;

    protected array $filterPillValues = [];

    public function setFilterPillTitle(string $title): self
    {
        $this->filterPillTitle = $title;

        return $this;
    }

    /**
     * @param  array<mixed>  $values
     */
    public function setFilterPillValues(array $values): self
    {
        $this->filterPillValues = $values;

        return $this;
    }

    public function getCustomFilterPillTitle(): ?string
    {
        return $this->filterPillTitle;
    }

    public function getFilterPillTitle(): string
    {
        return $this->getCustomFilterPillTitle() ?? $this->getName();
    }

    /**
     * @param  mixed  $value
     */
    public function getFilterPillValue($value): array|string|bool|null
    {
        return $value;
    }

    /**
     * @return array<mixed>
     */
    public function getCustomFilterPillValues(): array
    {
        return $this->filterPillValues;
    }

    public function getCustomFilterPillValue(string $value): ?string
    {
        return $this->getCustomFilterPillValues()[$value] ?? null;
    }
}
