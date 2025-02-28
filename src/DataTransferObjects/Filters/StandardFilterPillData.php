<?php

namespace Rappasoft\LaravelLivewireTables\DataTransferObjects\Filters;

class StandardFilterPillData
{
    public function __construct(protected string $filterPillTitle, protected string $filterSelectName, protected string $filterPillValue, protected bool $renderPillsAsHtml) {}

    public static function make(string $filterPillTitle, string $filterSelectName, string $filterPillValue, bool $renderPillsAsHtml = false): StandardFilterPillData
    {
        return new self($filterPillTitle, $filterSelectName, $filterPillValue, $renderPillsAsHtml);
    }

    public function getTitle(): string
    {
        return $this->filterPillTitle;
    }

    public function getSelectName(): string
    {
        return $this->filterSelectName;
    }

    public function getPillValue(): string
    {
        return $this->filterPillValue;
    }

    public function shouldUsePillsAsHtml(): bool
    {
        return $this->renderPillsAsHtml ?? false;
    }

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
