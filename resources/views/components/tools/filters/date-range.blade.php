@php
    $filterKey = $filter->getKey();
    $filterConfigs = $filter->getConfigs();
    $dateString = $filter->getDateString(isset($this->appliedFilters[$filterKey]) ? $this->appliedFilters[$filterKey] : '');  
@endphp

<div x-cloak id="{{ $tableName }}-dateRangeFilter-{{ $filterKey }}" x-data="flatpickrFilter($wire, '{{ $filterKey }}', @js($filter->getConfigs()), $refs.dateRangeInput, '{{ App::currentLocale() }}')" >
    <div>
        <x-livewire-tables::tools.filter-label :$filter :$filterLayout :$tableName :$isTailwind :$isBootstrap4 :$isBootstrap5 :$isBootstrap />
        <div
            @class([
                'w-full rounded-md shadow-sm text-left ' => $isTailwind,
                'd-inline-block w-100 mb-3 mb-md-0 input-group' => $isBootstrap,
            ])
        >
            <input
                type="text"
                x-ref="dateRangeInput"
                x-on:click="init"
                value="{{ $dateString }}"
                wire:key="{{ $filter->generateWireKey($tableName, 'dateRange') }}"
                id="{{ $tableName }}-filter-dateRange-{{ $filterKey }}"
                @class([
                    'w-10/12 inline-block align-middle transition duration-150 ease-in-out border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-800 dark:text-white dark:border-gray-600' => $isTailwind,
                    'd-inline-block form-control transition duration-150 ease-in-out border border-gray rounded-sm shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-800 dark:text-white dark:border-gray-600' => $isBootstrap,
                ])
                @style([
                    'width: 80%;' => $isBootstrap,
                ])
            />
            @if($isTailwind)
                <x-heroicon-o-calendar-days class="inline-block w-6 h-6 align-middle text-black dark:text-white group-hover:opacity-0"  />
            @else
                <x-heroicon-o-calendar-days class="d-inline-block" style="width:1em; height:1em;" />
            @endif            
        </div>
    </div>
</div>
