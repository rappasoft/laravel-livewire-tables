@php
    $filterKey = $filter->getKey();
    $filterBasePath = 'filterComponents.' . $filterKey;
    $filterName = $filter->getName();
    $filterConfigs = $filter->getConfigs();
    $suffix = $filter->getConfig('suffix');

    $defaultMin = $currentMin = $filterMin = $minRange = $filter->getConfig('minRange');
    $defaultMax = $currentMax = $filterMax = $maxRange = $filter->getConfig('maxRange');
    $minFilterWirePath = $filterBasePath . '.min';
    $maxFilterWirePath = $filterBasePath . '.max';

    if (isset($this->filterComponents)) {
        if (!empty($this->filterComponents[$filterKey])) {
            $currentMin = isset($this->filterComponents[$filterKey]['min']) ? $this->filterComponents[$filterKey]['min'] : $defaultMin;
            $currentMax = isset($this->filterComponents[$filterKey]['max']) ? $this->filterComponents[$filterKey]['max'] : $defaultMax;
        }
    }
    $lightStyling = $filter->getConfig('styling')['light'];
    $darkStyling = $filter->getConfig('styling')['dark'];
    $filterContainerName = "numberRangeContainer";

@endphp
<div id="{{ $filterContainerName }}{{ $filterKey }}" x-data="{
    allFilters: $wire.entangle('{{ $tableName }}.filters'),
    @if ($isTailwind) twMenuElements: document.getElementsByClassName('relative block md:inline-block text-left'), @endif
    @if ($isBootstrap) bsMenuElements: document.getElementsByClassName('btn-group d-block d-md-inline'), @endif
    currentMin: $refs.filterMin.value,
    currentMax: $refs.filterMax.value,
    wireValues: $wire.entangle('{{ $filterBasePath }}').live,
    defaultMin: {{ $minRange }},
    defaultMax: {{ $maxRange }},
    restrictUpdates: false,

    updateStyles() {
        let numRangeFilterContainer = document.getElementById('{{ $filterBasePath }}');
        numRangeFilterContainer.style.setProperty('--value-b', $refs.filterMin.value);
        numRangeFilterContainer.style.setProperty('--text-value-b', JSON.stringify($refs.filterMin.value));
        numRangeFilterContainer.style.setProperty('--value-a', $refs.filterMax.value);
        numRangeFilterContainer.style.setProperty('--text-value-a', JSON.stringify($refs.filterMax.value));
    },
    setupWire() {
        if (this.wireValues !== undefined) {
            $refs.filterMin.value = (this.wireValues['min'] !== undefined) ? this.wireValues['min'] : this.defaultMin;
            $refs.filterMax.value = (this.wireValues['max'] !== undefined) ? this.wireValues['max'] : this.defaultMax;
        } else {
            $refs.filterMin.value = this.defaultMin;
            $refs.filterMax.value = this.defaultMax;
        }
        this.updateStyles();
    },
    allowUpdates() {
        this.updateWire();
    },
    updateWire() {
        this.updateStyles();
            if (this.wireValues != undefined) {
                if (this.wireValues['min'] != undefined || this.wireValues['max'] != undefined)
                {
                    if (this.wireValues['min'] != $refs.filterMin.value || this.wireValues['max'] != $refs.filterMax.value)
                    {
                        this.wireValues = { 'min': $refs.filterMin.value, 'max': $refs.filterMax.value };
                    }
                }
                else if ($refs.filterMin.value != this.defaultMin || $refs.filterMax.value != this.defaultMax) {
                    this.wireValues = { 'min': $refs.filterMin.value, 'max': $refs.filterMax.value };
                }
            }
            else if ($refs.filterMin.value != this.defaultMin || $refs.filterMax.value != this.defaultMax) {
                this.wireValues = { 'min': $refs.filterMin.value, 'max': $refs.filterMax.value };
            }
    },
    init() {
        this.setupWire();
        $watch('allFilters', value => this.setupWire());
    },
}">
    @if ($isTailwind)

        @if($filter->hasCustomFilterLabel() && !$filter->hasCustomPosition())
            @include($filter->getCustomFilterLabel(),['filter' => $filter, 'filterLayout' => $filterLayout, 'tableName' => $tableName  ])
        @elseif(!$filter->hasCustomPosition())
            <x-livewire-tables::tools.filter-label :filter="$filter" :filterLayout="$filterLayout" :tableName="$tableName"  />
        @endif

        <div class="mt-4 h-22 pt-8 pb-4 grid gap-10">
            <div x-on:mousedown.away="allowUpdates" x-on:touchstart.away="allowUpdates" x-on:mouseleave="allowUpdates"
                class="range-slider flat" id="{{ $filterBasePath }}" data-ticks-position='bottom'
                style='--min:{{ $minRange }};
                --max:{{ $maxRange }};
                --value-a:{{ $currentMax }};
                --value-b:{{ $currentMin }};
                --suffix:"{{ $suffix }}";
                --text-value-a:"{{ $currentMax }}";
                --text-value-b:"{{ $currentMin }}";
                '>

                <input type="range" min="{{ $minRange }}" max="{{ $maxRange }}" value="{{ $currentMax }}"
                    id="{{ $maxFilterWirePath }}" x-ref='filterMax' x-on:change="updateWire()" 
                    oninput="this.parentNode.style.setProperty('--value-a',this.value); this.parentNode.style.setProperty('--text-value-a', JSON.stringify(this.value))"
                    />
                <output></output>
                <input type="range" min="{{ $minRange }}" max="{{ $maxRange }}" value="{{ $currentMin }}"
                    id="{{ $minFilterWirePath }}" x-ref='filterMin' x-on:change="updateWire()"
                    oninput="this.parentNode.style.setProperty('--value-b',this.value); this.parentNode.style.setProperty('--text-value-b', JSON.stringify(this.value))"
                    />
                <output></output>
                <div class='range-slider__progress'></div>
            </div>
        </div>
    @elseif ($isBootstrap4)
        @if($filter->hasCustomFilterLabel() && !$filter->hasCustomPosition())
            @include($filter->getCustomFilterLabel(),['filter' => $filter, 'filterLayout' => $filterLayout, 'tableName' => $tableName  ])
        @elseif(!$filter->hasCustomPosition())
            <x-livewire-tables::tools.filter-label :filter="$filter" :filterLayout="$filterLayout" :tableName="$tableName"  />
        @endif
        <div class="mt-4 h-22 w-100 pb-4 pt-2  grid gap-10" x-on:mouseleave="allowUpdates">
            <div class="range-slider flat w-100" id="{{ $filterBasePath }}" data-ticks-position='bottom'
                style='--min:{{ $minRange }};
                    --max:{{ $maxRange }};
                    --value-a:{{ $currentMax }};
                    --value-b:{{ $currentMin }};
                    --suffix:"{{ $suffix }}";
                    --text-value-a:"{{ $currentMax }}";
                    --text-value-b:"{{ $currentMin }}";
                    '>

                <input type="range" min="{{ $minRange }}" max="{{ $maxRange }}" value="{{ $currentMax }}"
                oninput="this.parentNode.style.setProperty('--value-a',this.value); this.parentNode.style.setProperty('--text-value-a', JSON.stringify(this.value))"

                    id="{{ $maxFilterWirePath }}" x-ref='filterMax' x-on:change="updateWire()" />
                <output></output>
                <input type="range" min="{{ $minRange }}" max="{{ $maxRange }}" value="{{ $currentMin }}"
                oninput="this.parentNode.style.setProperty('--value-b',this.value); this.parentNode.style.setProperty('--text-value-b', JSON.stringify(this.value))"

                    id="{{ $minFilterWirePath }}" x-ref='filterMin' x-on:change="updateWire()" />
                <output></output>
                <div class='range-slider__progress'></div>
            </div>
        </div>
    @elseif ($isBootstrap5)
        @if($filter->hasCustomFilterLabel() && !$filter->hasCustomPosition())
            @include($filter->getCustomFilterLabel(),['filter' => $filter, 'filterLayout' => $filterLayout, 'tableName' => $tableName  ])
        @elseif(!$filter->hasCustomPosition())
            <x-livewire-tables::tools.filter-label :filter="$filter" :filterLayout="$filterLayout" :tableName="$tableName"  />
        @endif
        
        <div class="mt-4 h-22 w-100 pb-4 pt-2  grid gap-10" x-on:mouseleave="allowUpdates">
            <div class="range-slider flat w-100" id="{{ $filterBasePath }}" data-ticks-position='bottom'
                style='--min:{{ $minRange }};
            --max:{{ $maxRange }};
            --value-a:{{ $currentMax }};
            --value-b:{{ $currentMin }};
            --suffix:"{{ $suffix }}";
            --text-value-a:"{{ $currentMax }}";
            --text-value-b:"{{ $currentMin }}";
            '>

                <input type="range" min="{{ $minRange }}" max="{{ $maxRange }}" value="{{ $currentMax }}"
                oninput="this.parentNode.style.setProperty('--value-a',this.value); this.parentNode.style.setProperty('--text-value-a', JSON.stringify(this.value))"

                    id="{{ $maxFilterWirePath }}" x-ref='filterMax' x-on:change="updateWire()" />
                <output></output>
                <input type="range" min="{{ $minRange }}" max="{{ $maxRange }}" value="{{ $currentMin }}"
                oninput="this.parentNode.style.setProperty('--value-b',this.value); this.parentNode.style.setProperty('--text-value-b', JSON.stringify(this.value))"

                    id="{{ $minFilterWirePath }}" x-ref='filterMin' x-on:change="updateWire()" />
                <output></output>
                <div class='range-slider__progress'></div>
            </div>
        </div>
    @endif

</div>
