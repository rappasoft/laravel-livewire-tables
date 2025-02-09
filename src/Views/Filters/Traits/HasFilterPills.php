<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

use Rappasoft\LaravelLivewireTables\Views\Filters\Traits\Styling\HandlesFilterPillsAttributes;

trait HasFilterPills
{
    use HandlesFilterPillsAttributes;

    protected ?string $filterPillTitle = null;

    protected array $filterPillValues = [];

    protected ?string $filterCustomPillBlade = null;

    protected bool $pillsAsHtml = false;

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

    public function setFilterPillBlade(string $blade): self
    {
        $this->filterCustomPillBlade = $blade;

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

    /**
     * Determine if filter has a Custom Pill Blade
     */
    public function hasCustomPillBlade(): bool
    {
        return $this->filterCustomPillBlade != null;
    }

    /**
     * Get the path to the Custom Pill Blade
     */
    public function getCustomPillBlade(): ?string
    {
        return $this->filterCustomPillBlade;
    }

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
