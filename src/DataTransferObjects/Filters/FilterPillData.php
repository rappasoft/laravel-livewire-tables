<?php

namespace Rappasoft\LaravelLivewireTables\DataTransferObjects\Filters;

use Illuminate\View\ComponentAttributeBag;

class FilterPillData
{
    public string $separatedValues = '';

    public function __construct(
        protected string $filterKey,
        protected string $filterPillTitle,
        protected string|array|null $filterPillValue,
        protected string $separator,
        public bool $isAnExternalLivewireFilter,
        public bool $hasCustomPillBlade,
        protected ?string $customPillBlade,
        protected array $filterPillsItemAttributes,
        protected bool $renderPillsAsHtml,
        protected bool $watchForEvents,
        protected array $customResetButtonAttributes,
        protected bool $renderPillsTitleAsHtml) {}

    public static function make(string $filterKey, string $filterPillTitle, string|array|null $filterPillValue, string $separator = ', ', bool $isAnExternalLivewireFilter = false, bool $hasCustomPillBlade = false, ?string $customPillBlade = null, array $filterPillsItemAttributes = [], bool $renderPillsAsHtml = false, bool $watchForEvents = false, array $customResetButtonAttributes = [], bool $renderPillsTitleAsHtml = false): FilterPillData
    {
        if ($isAnExternalLivewireFilter) {
            $watchForEvents = true;
        }

        return new self($filterKey, $filterPillTitle, $filterPillValue, $separator, $isAnExternalLivewireFilter, $hasCustomPillBlade, $customPillBlade, $filterPillsItemAttributes, $renderPillsAsHtml, $watchForEvents, $customResetButtonAttributes, $renderPillsTitleAsHtml);
    }

    /**
     * Get the Filter Key
     */
    public function getFilterKey(): string
    {
        return $this->filterKey;
    }

    /**
     * Get the title for the Filter Pill
     */
    public function getTitle(): string
    {
        return $this->filterPillTitle;
    }

    /**
     * Get The Filter Pill Value
     *
     * @return array<mixed>|string|null
     */
    public function getPillValue(): array|string|null
    {
        return $this->filterPillValue;
    }

    /**
     * Determing if there is a Custom Pill blade set
     */
    public function getHasCustomPillBlade(): bool
    {
        return $this->hasCustomPillBlade;
    }

    /**
     * Get The Custom Pill Blade (if set)
     */
    public function getCustomPillBlade(): ?string
    {
        return $this->customPillBlade;
    }

    /**
     * Get Custom Reset Button Attributes
     *
     * @return array<mixed>
     */
    public function getCustomResetButtonAttributes(): array
    {
        return $this->customResetButtonAttributes;
    }

    /**
     * Determine of this is an External Livewire Filter
     */
    public function getIsAnExternalLivewireFilter(): int
    {
        return intval($this->isAnExternalLivewireFilter);
    }

    /**
     * Get the Separator for Pill Values
     */
    public function getSeparator(): string
    {
        return $this->separator;
    }

    /**
     * Determine if Pills should render as HTML
     */
    public function shouldUsePillsAsHtml(): int
    {
        return intval($this->renderPillsAsHtml);
    }

    /**
     * Determine if Pill Title should render as HTML
     */
    public function shouldUsePillsTitleAsHtml(): int
    {
        return intval($this->renderPillsTitleAsHtml);
    }

    /**
     * Determine if Should watch for Events (i.e. is an External Filter)
     */
    public function shouldWatchForEvents(): int
    {
        return intval($this->watchForEvents);
    }

    /**
     * Determine if Pill Value is an Array
     */
    public function isPillValueAnArray(): bool
    {
        return ! is_null($this->filterPillValue) && is_array($this->filterPillValue);
    }

    /**
     * Return the separator separated value for the pill
     */
    public function getSeparatedPillValue(): ?string
    {
        if ($this->isPillValueAnArray()) {
            return implode($this->getSeparator(), $this->getPillValue());
        } else {
            return $this->getPillValue();
        }
    }

    /**
     * Return the safe, separator separated value for the pill
     */
    public function getSafeSeparatedPillValue(): ?string
    {
        $string = $this->getSeparatedPillValue();

        return htmlentities($string, ENT_QUOTES, 'UTF-8');

    }

    /**
     * Get the attributes for the Filter Pills Item
     *
     * @return array<mixed>
     */
    public function getFilterPillsItemAttributes(): array
    {
        return array_merge(['default' => true, 'default-colors' => true, 'default-styling' => true, 'default-text' => true], $this->filterPillsItemAttributes);
    }

    /**
     * Get the Display Data for the Filter Pills
     *
     * @return array<mixed>
     */
    public function getFilterPillDisplayDataArray(): array
    {
        $array = [];
        if ($this->getIsAnExternalLivewireFilter()) {
            return $this->getExternalFilterPillDisplayDataArray($array);
        }

        return $this->getInternalFilterPillDisplayDataArray($array);
    }

    /**
     * Get the Display Data for the Filter Pills
     *
     * @param  array<mixed>  $array
     * @return array<mixed>
     */
    public function getExternalFilterPillDisplayDataArray(array $array = []): array
    {
        $array[$this->shouldUsePillsAsHtml() ? 'x-html' : 'x-text'] = 'displayString';

        return $array;
    }

    /**
     * Get the Display Data for the Filter Pills
     *
     * @param  array<mixed>  $array
     * @return array<mixed>
     */
    public function getInternalFilterPillDisplayDataArray(array $array = []): array
    {

        $array['x-data'] = "{ internalDisplayString: ''}";
        $array['x-init'] = 'internalDisplayString = updatePillValues('.json_encode($this->getSafeSeparatedPillValue()).')';
        $array[$this->shouldUsePillsAsHtml() ? 'x-html' : 'x-text'] = 'internalDisplayString';

        return $array;
    }

    /**
     * Get the Display Data for the Filter Pills Title
     *
     * @param  array<mixed>  $array
     * @return array<mixed>
     */
    public function getFilterTitleDisplayDataArray(array $array = []): array
    {
        $array[$this->shouldUsePillsTitleAsHtml() ? 'x-html' : 'x-text'] = 'localFilterTitle';

        return $array;
    }

    /**
     * Get the initial setup data
     *
     * @return array<mixed>
     */
    public function getPillSetupData(string $filterKey = '', bool $shouldWatch = false): array
    {
        $array = array_merge(['filterKey' => $filterKey, 'watchForEvents' => $shouldWatch], $this->toArray());

        return $array;
    }

    /**
     * Calculate Any Reset Button Attributes
     *
     * @param  array<mixed>  $filterPillsResetFilterButtonAttributes
     * @return array<mixed>
     */
    public function getCalculatedCustomResetButtonAttributes(string $filterKey, array $filterPillsResetFilterButtonAttributes): array
    {
        return array_merge(
            [
                'x-on:click.prevent' => "resetSpecificFilter('".$filterKey."')",
                'type' => 'button',
                'default' => true,
                'default-colors' => true,
                'default-styling' => true,
                'default-text' => true,
            ],
            $filterPillsResetFilterButtonAttributes,
            $this->getCustomResetButtonAttributes()
        );
    }

    /**
     * Returns the data to an array
     *
     * @return array<mixed>
     */
    public function toArray(): array
    {
        return [
            'filterKey' => $this->getFilterKey(),
            'filterPillTitle' => $this->getTitle(),
            'filterPillValue' => $this->getPillValue(),
            'isAnExternalLivewireFilter' => $this->getIsAnExternalLivewireFilter(),
            'hasCustomPillBlade' => $this->getHasCustomPillBlade(),
            'customPillBlade' => $this->getCustomPillBlade(),
            'separator' => $this->getSeparator(),
            'separatedValues' => $this->getSafeSeparatedPillValue(),
            'filterPillsItemAttributes' => $this->getFilterPillsItemAttributes(),
            'renderPillsAsHtml' => $this->shouldUsePillsAsHtml(),
            'renderPillsTitleAsHtml' => $this->shouldUsePillsTitleAsHtml(),
            'watchForEvents' => $this->shouldWatchForEvents(),
        ];
    }
}
