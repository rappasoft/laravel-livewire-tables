<?php

namespace Rappasoft\LaravelLivewireTables\DataTransferObjects\Filters;

class StandardFilterPillData
{
    public function __construct(protected string $filterPillTitle, protected string $filterSelectName, protected string $filterPillValue, protected bool $renderPillsAsHtml) {}

    public static function make(string $filterPillTitle, string $filterSelectName, string $filterPillValue, bool $renderPillsAsHtml = false): StandardFilterPillData
    {
        return new self($filterPillTitle, $filterSelectName, $filterPillValue, $renderPillsAsHtml);
    }

    /**
     * Get the Pill Title
     */
    public function getTitle(): string
    {
        return $this->filterPillTitle;
    }

    /**
     * Get the Filter Select Name
     */
    public function getSelectName(): string
    {
        return $this->filterSelectName;
    }

    /**
     * Get The Pill Value
     */
    public function getPillValue(): string
    {
        return $this->filterPillValue;
    }

    /**
     * Should Use Pills as HTML
     */
    public function shouldUsePillsAsHtml(): bool
    {
        return $this->renderPillsAsHtml;
    }

    /**
     * Returns the data to an array
     *
     * @return array<mixed>
     */
    public function toArray(): array
    {
        return [
            'filterPillTitle' => $this->getTitle(),
            'filterSelectName' => $this->getSelectName(),
            'filterPillValue' => $this->getPillValue(),
            'renderPillsAsHtml' => $this->shouldUsePillsAsHtml(),
        ];
    }
}
