<?php

namespace Rappasoft\LaravelLivewireTables\DataTransferObjects\Filters;

class FilterPillData
{

    public function __construct(protected string $filterPillTitle, protected string $filterSelectName, protected string|array|null $filterPillValue, protected string $separator, public bool $isAnExternalLivewireFilter, public bool $hasCustomPillBlade, protected ?string $customPillBlade, protected array $filterPillsItemAttributes)
    {
    }

    public static function make(string $filterPillTitle, string $filterSelectName, string|array|null $filterPillValue, string $separator = ', ', bool $isAnExternalLivewireFilter = false, bool $hasCustomPillBlade = false, ?string $customPillBlade = null, array $filterPillsItemAttributes = []): FilterPillData 
    {
        return new self($filterPillTitle, $filterSelectName, $filterPillValue, $separator, $isAnExternalLivewireFilter, $hasCustomPillBlade, $customPillBlade, $filterPillsItemAttributes);
    }

    public function getTitle(): string
    {
        return $this->filterPillTitle;
    }

    public function getSelectName(): string
    {
        return $this->filterSelectName;
    }

    public function getPillValue(): array|string|null
    {
        return $this->filterPillValue;
    }
    
    public function isPillValueAnArray(): bool
    {
        return (!is_null($this->filterPillValue) && is_array($this->filterPillValue));
    }

    public function getSeparatedPillValue(): array|string|null
    {
        if ($this->isPillValueAnArray())
        {
            return implode($this->getSeparator(), $this->getPillValue());
        }
        else
        {
            return $this->getPillValue();
        }
    }

    public function getValueFromPillData(): array|string|null
    {
        if ($this->isPillValueAnArray())
        {
            return implode($this->getSeparator(), $this->getPillValue());
        }
        else
        {
            return $this->getPillValue();
        }
    }


    public function getHasCustomPillBlade(): bool
    {
        return $this->hasCustomPillBlade ?? false;
    }

    public function getCustomPillBlade(): string|null
    {
        return $this->customPillBlade;
    }

    public function getIsAnExternalLivewireFilter(): bool
    {
        return $this->isAnExternalLivewireFilter ?? false;
    }

    public function getSeparator(): string
    {
        return $this->separator ?? ", ";
    }

    public function getFilterPillsItemAttributes(): array
    {
        return array_merge(['default' => true, 'default-colors' => true, 'default-styling' => true], $this->filterPillsItemAttributes); 
    }

    public function toArray(): array
    {
        return [
            'filterPillTitle' => $this->getTitle(),
            'filterSelectName' => $this->getSelectName(),
            'filterPillValue' => $this->getPillValue(),
            'isAnExternalLivewireFilter' => $this->getIsAnExternalLivewireFilter(),
            'hasCustomPillBlade' => $this->getHasCustomPillBlade(),
            'customPillBlade' => $this->getCustomPillBlade(),
            'separator' => $this->getSeparator(),
            'filterPillsItemAttributes' => $this->getFilterPillsItemAttributes(),
        ];
    }
}
