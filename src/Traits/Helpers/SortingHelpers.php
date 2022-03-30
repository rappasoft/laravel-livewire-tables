<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait SortingHelpers
{
    /**
     * @return bool
     */
    public function getSortingStatus(): bool
    {
        return $this->sortingStatus;
    }

    /**
     * @return bool
     */
    public function getSingleSortingStatus(): bool
    {
        return $this->singleColumnSortingStatus;
    }

    /**
     * @return array
     */
    public function getSorts(): array
    {
        return $this->{$this->getTableName()}['sorts'] ?? [];
    }

    /**
     * @param  array  $sorts
     *
     * @return array
     */
    public function setSorts(array $sorts): array
    {
        return $this->{$this->getTableName()}['sorts'] = $sorts;
    }

    /**
     * @param  string  $field
     *
     * @return string|null
     */
    public function getSort(string $field): ?string
    {
        return $this->{$this->getTableName()}['sorts'][$field] ?? null;
    }

    /**
     * @param  string  $field
     * @param  string  $direction
     *
     * @return string
     */
    public function setSort(string $field, string $direction): string
    {
        return $this->{$this->getTableName()}['sorts'][$field] = $direction;
    }

    /**
     * @return bool
     */
    public function hasSorts(): bool
    {
        return count($this->getSorts());
    }

    /**
     * @param  string  $field
     *
     * @return bool
     */
    public function hasSort(string $field): bool
    {
        return $this->getSort($field) !== null;
    }

    /**
     * Clear the sorts array
     */
    public function clearSorts(): void
    {
        $this->{$this->getTableName()}['sorts'] = [];
    }

    /**
     * @param  string  $field
     */
    public function clearSort(string $field): void
    {
        unset($this->{$this->getTableName()}['sorts'][$field]);
    }

    /**
     * @param  string  $field
     *
     * @return string
     */
    public function setSortAsc(string $field): string
    {
        return $this->setSort($field, 'asc');
    }

    /**
     * @param  string  $field
     *
     * @return string
     */
    public function setSortDesc(string $field): string
    {
        return $this->setSort($field, 'desc');
    }

    /**
     * @param  string  $field
     *
     * @return bool
     */
    public function isSortAsc(string $field): bool
    {
        return $this->getSort($field) === 'asc';
    }

    /**
     * @param  string  $field
     *
     * @return bool
     */
    public function isSortDesc(string $field): bool
    {
        return $this->getSort($field) === 'desc';
    }

    /**
     * @return bool
     */
    public function sortingIsEnabled(): bool
    {
        return $this->getSortingStatus() === true;
    }

    /**
     * @return bool
     */
    public function sortingIsDisabled(): bool
    {
        return $this->getSortingStatus() === false;
    }

    /**
     * @return bool
     */
    public function singleSortingIsEnabled(): bool
    {
        return $this->getSingleSortingStatus() === true;
    }

    /**
     * @return bool
     */
    public function singleSortingIsDisabled(): bool
    {
        return $this->getSingleSortingStatus() === false;
    }

    /**
     * @return bool
     */
    public function hasDefaultSort(): bool
    {
        return $this->getDefaultSortColumn() !== null;
    }

    /**
     * @return string|null
     */
    public function getDefaultSortColumn(): ?string
    {
        return $this->defaultSortColumn;
    }

    /**
     * @return string
     */
    public function getDefaultSortDirection(): string
    {
        return $this->defaultSortDirection;
    }

    /**
     * @return bool
     */
    public function getSortingPillsStatus(): bool
    {
        return $this->sortingPillsStatus;
    }

    /**
     * @return bool
     */
    public function sortingPillsAreEnabled(): bool
    {
        return $this->getSortingPillsStatus() === true;
    }

    /**
     * @return bool
     */
    public function sortingPillsAreDisabled(): bool
    {
        return $this->getSortingPillsStatus() === false;
    }

    /**
     * @return string
     */
    public function getDefaultSortingLabelAsc(): string
    {
        return $this->defaultSortingLabelAsc;
    }

    /**
     * @return string
     */
    public function getDefaultSortingLabelDesc(): string
    {
        return $this->defaultSortingLabelDesc;
    }
}
