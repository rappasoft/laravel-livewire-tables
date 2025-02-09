<?php

namespace Rappasoft\LaravelLivewireTables\DataTransferObjects\Filters;

use Illuminate\View\ComponentAttributeBag;

class FilterPillData
{
    public function __construct(
        protected string $filterPillTitle, 
        protected string $filterSelectName, 
        protected string|array|null $filterPillValue, 
        protected string $separator, 
        public bool $isAnExternalLivewireFilter, 
        public bool $hasCustomPillBlade, 
        protected ?string $customPillBlade, 
        protected array $filterPillsItemAttributes, 
        protected ?string $separatedValues, 
        protected bool $renderPillsAsHtml,
        protected bool $watchForEvents,
        protected array $customResetButtonAttributes,) {}

    public static function make(string $filterPillTitle, string $filterSelectName, string|array|null $filterPillValue, string $separator = ', ', bool $isAnExternalLivewireFilter = false, bool $hasCustomPillBlade = false, ?string $customPillBlade = null, array $filterPillsItemAttributes = [], ?string $separatedValues = null, bool $renderPillsAsHtml = false, bool $watchForEvents = false, array $customResetButtonAttributes = []): FilterPillData
    {
        if ($isAnExternalLivewireFilter)
        {
            $watchForEvents = true;
        }
        return new self($filterPillTitle, $filterSelectName, $filterPillValue, $separator, $isAnExternalLivewireFilter, $hasCustomPillBlade, $customPillBlade, $filterPillsItemAttributes, $separatedValues, $renderPillsAsHtml, $watchForEvents, $customResetButtonAttributes);
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
        return ! is_null($this->filterPillValue) && is_array($this->filterPillValue);
    }

    public function getSeparatedPillValue(): array|string|null
    {
        if ($this->isPillValueAnArray()) {
            return implode($this->getSeparator(), $this->getPillValue());
        } else {
            return $this->getPillValue();
        }
    }

    public function getValueFromPillData(): array|string|null
    {
        if ($this->isPillValueAnArray()) {
            return implode($this->getSeparator(), $this->getPillValue());
        } else {
            return $this->getPillValue();
        }
    }

    public function getHasCustomPillBlade(): bool
    {
        return $this->hasCustomPillBlade ?? false;
    }

    public function getCustomPillBlade(): ?string
    {
        return $this->customPillBlade;
    }

    public function getIsAnExternalLivewireFilter(): int
    {
        return intval($this->isAnExternalLivewireFilter ?? false);
    }

    public function getSeparator(): string
    {
        return $this->separator ?? ', ';
    }

    public function getSeparatedValues(): string
    {
        return $this->separatedValues ?? $this->getSeparatedPillValue();
    }

    public function getFilterPillsItemAttributes(): array
    {
        return array_merge(['default' => true, 'default-colors' => true, 'default-styling' => true, 'default-text' => true], $this->filterPillsItemAttributes);
    }

    public function shouldUsePillsAsHtml(): int
    {
        return intval($this->renderPillsAsHtml ?? false);
    }

    public function shouldWatchForEvents(): int
    {
        return intval($this->watchForEvents ?? false);
    }

    public function getFilterPillDisplayData(): ComponentAttributeBag
    {
        if ($this->getIsAnExternalLivewireFilter())
        {
            return $this->getExternalFilterPillDisplayData();
        }

        return $this->getInternalFilterPillDisplayData();
    }


    public function getInternalFilterPillDisplayData(): ComponentAttributeBag
    {
        return new ComponentAttributeBag([
            'x-data' => "{ internalDisplayString: ''}",
            'x-init' => "internalDisplayString = updatePillValues('".$this->getSeparatedValues()."');",
            $this->shouldUsePillsAsHtml() ? 'x-html' : 'x-text' => 'internalDisplayString',
        ]);
    }

    public function getExternalFilterPillDisplayData(): ComponentAttributeBag
    {
        return new ComponentAttributeBag([
            $this->shouldUsePillsAsHtml() ? 'x-html' : 'x-text' => 'displayString',
        ]);
    }


    public function getPillSetupData(string $filterKey = '', bool $shouldWatch = false): array
    {
        $array = array_merge(['filterKey' => $filterKey, 'watchForEvents' => $shouldWatch], $this->toArray());
        return $array;
    }

    public function getCustomResetButtonAttributes(): array
    {
        return $this->customResetButtonAttributes ?? [];
    }

    public function getCalculatedCustomResetButtonAttributes(string $filterKey, array $filterPillsResetFilterButtonAttributes): array
    {
        return (array_merge(
            [
                'x-on:click.prevent' => "resetSpecificFilter('".$filterKey."')",
                'type' => "button",
                'default' => true, 
                'default-colors' => true,
                'default-styling' => true, 
                'default-text' => true,
            ],
            $filterPillsResetFilterButtonAttributes,
            $this->getCustomResetButtonAttributes()
        ));
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
            'separatedValues' => $this->getSeparatedValues(),
            'renderPillsAsHtml' => $this->shouldUsePillsAsHtml(),
            'watchForEvents' => $this->shouldWatchForEvents(),
        ];
    }
}
