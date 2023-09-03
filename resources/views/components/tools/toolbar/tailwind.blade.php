<div class="md:flex md:justify-between mb-4 px-4 md:p-0">
    <div class="w-full mb-4 md:mb-0 md:w-2/4 md:flex space-y-4 md:space-y-0 md:space-x-2">
        <div x-show="!currentlyReorderingStatus">
            @if ($component->hasConfigurableAreaFor('toolbar-left-start'))
                @include($component->getConfigurableAreaFor('toolbar-left-start'), $component->getParametersForConfigurableArea('toolbar-left-start'))
            @endif
        </div>

        <div x-show="reorderStatus">
            <button
                x-on:click="reorderToggle"
                type="button"
                class="inline-flex justify-center items-center w-full md:w-auto px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600"
            >
                <span x-show="currentlyReorderingStatus">
                    @lang('Cancel')
                </span>

                <span x-show="!currentlyReorderingStatus">
                    @lang('Reorder')
                </span>
            </button>

            <button
                type="button"
                class="inline-flex justify-center items-center w-full md:w-auto px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600"
                x-show="currentlyReorderingStatus" x-on:click="updateOrderedItems">
                @lang('Save')
            </button>
        </div>

        @if ($component->searchIsEnabled() && $component->searchVisibilityIsEnabled())
            <div x-show="!currentlyReorderingStatus" class="flex rounded-md shadow-sm">
                <input
                    wire:model{{ $component->getSearchOptions() }}="search"
                    placeholder="{{ $component->getSearchPlaceholder() }}"
                    type="text"
                    class="block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-700 dark:text-white dark:border-gray-600 @if ($component->hasSearch()) rounded-none rounded-l-md focus:ring-0 focus:border-gray-300 @else focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md @endif"
                />

                @if ($component->hasSearch())
                    <span
                        wire:click="clearSearch"
                        class="inline-flex items-center px-3 text-gray-500 bg-gray-50 rounded-r-md border border-l-0 border-gray-300 cursor-pointer sm:text-sm dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600"
                    >
                        <x-heroicon-m-x-mark class="w-4 h-4" />
                    </span>
                @endif
            </div>
        @endif

        @if ($component->filtersAreEnabled() && $component->filtersVisibilityIsEnabled() && $component->hasVisibleFilters())
            <div
                x-show="!currentlyReorderingStatus" @if ($component->isFilterLayoutPopover())
                x-data="{ filterPopoverOpen: false }"
                x-on:keydown.escape.stop="if (!window.childElementOpen) { filterPopoverOpen = false }"
                x-on:mousedown.away="if (!window.childElementOpen) { filterPopoverOpen = false }" @endif
                class="relative block md:inline-block text-left"
            >
                <div>
                    <button
                        type="button"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600"
                        @if ($component->isFilterLayoutPopover()) x-on:click="filterPopoverOpen = !filterPopoverOpen"
                        aria-haspopup="true"
                        x-bind:aria-expanded="filterPopoverOpen"
                        aria-expanded="true" @endif
                        @if ($component->isFilterLayoutSlideDown()) x-on:click="filtersOpen = !filtersOpen" @endif
                    >
                        @lang('Filters')

                        @if ($count = $component->getFilterBadgeCount())
                            <span
                                class="ml-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-indigo-100 text-indigo-800 capitalize dark:bg-indigo-200 dark:text-indigo-900">
                                    {{ $count }}
                            </span>
                        @endif

                        <x-heroicon-o-funnel class="-mr-1 ml-2 h-5 w-5" />
                    </button>
                </div>

                @if ($component->isFilterLayoutPopover())
                    <div
                        x-cloak
                        x-show="filterPopoverOpen"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="origin-top-left absolute left-0 mt-2 w-full md:w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none z-50 dark:bg-gray-700 dark:text-white dark:divide-gray-600"
                        role="menu"
                        aria-orientation="vertical"
                        aria-labelledby="filters-menu"
                    >
                        @foreach ($component->getVisibleFilters() as $filter)
                            <div class="py-1" role="none">
                                <div
                                    class="block px-4 py-2 text-sm text-gray-700 space-y-1"
                                    role="menuitem"
                                    id="{{ $tableName }}-filter-{{ $filter->getKey() }}-wrapper"
                                >
                                    {{ $filter->render($component->filterLayout, $tableName, $component->isTailwind(), $component->isBootstrap4(), $component->isBootstrap5()) }}
                                </div>
                            </div>
                        @endforeach

                        @if ($component->hasAppliedVisibleFiltersWithValuesThatCanBeCleared())
                            <div class="block px-4 py-3 text-sm text-gray-700 dark:text-white" role="menuitem">
                                <button
                                    x-on:click="filterPopoverOpen = false"
                                    wire:click.prevent="setFilterDefaults"
                                    type="button"
                                    class="w-full inline-flex items-center justify-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:hover:border-gray-500"
                                >
                                    @lang('Clear')
                                </button>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        @endif

        @if ($component->hasConfigurableAreaFor('toolbar-left-end'))
            <div x-show="!currentlyReorderingStatus">
                @include($component->getConfigurableAreaFor('toolbar-left-end'), $component->getParametersForConfigurableArea('toolbar-left-end'))
            </div>
        @endif
    </div>

    <div x-show="!currentlyReorderingStatus" class="md:flex md:items-center space-y-4 md:space-y-0 md:space-x-2">
        @if ($component->hasConfigurableAreaFor('toolbar-right-start'))
            @include($component->getConfigurableAreaFor('toolbar-right-start'), $component->getParametersForConfigurableArea('toolbar-right-start'))
        @endif

        @if ($component->showBulkActionsDropdownAlpine())
            <div
                x-cloak
                x-show="(selectedItems.length > 0 || alwaysShowBulkActions)"
                class="w-full md:w-auto mb-4 md:mb-0"
            >
                <div
                    x-data="{ open: false, childElementOpen: false }"
                    @keydown.window.escape="if (!childElementOpen) { open = false }"
                    x-on:click.away="if (!childElementOpen) { open = false }"
                    class="relative inline-block text-left z-10 w-full md:w-auto"
                >
                    <div>
                        <span class="rounded-md shadow-sm">
                            <button
                                x-on:click="open = !open"
                                type="button"
                                class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600"
                                aria-haspopup="true"
                                x-bind:aria-expanded="open"
                                aria-expanded="true"
                            >
                                @lang('Bulk Actions')

                                <x-heroicon-m-chevron-down class="-mr-1 ml-2 h-5 w-5" />
                            </button>
                        </span>
                    </div>

                    <div
                        x-cloak
                        x-show="open"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="origin-top-right absolute right-0 mt-2 w-full md:w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none z-50"
                    >
                        <div class="rounded-md bg-white shadow-xs dark:bg-gray-700 dark:text-white">
                            <div class="py-1" role="menu" aria-orientation="vertical">
                                @foreach ($component->getBulkActions() as $action => $title)
                                    <button
                                        wire:click="{{ $action }}"
                                        wire:key="{{ $tableName }}-bulk-action-{{ $action }}"
                                        type="button"
                                        class="block w-full px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 flex items-center space-x-2 dark:text-white dark:hover:bg-gray-600"
                                        role="menuitem"
                                    >
                                        <span>{{ $title }}</span>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($component->columnSelectIsEnabled())
            <div
                class="@if ($component->getColumnSelectIsHiddenOnMobile()) hidden sm:block @elseif ($component->getColumnSelectIsHiddenOnTablet()) hidden md:block @endif mb-4 w-full md:w-auto md:mb-0 md:ml-2"
            >
                <div
                    x-data="{ open: false, childElementOpen: false }"
                    @keydown.window.escape="if (!childElementOpen) { open = false }"
                    x-on:click.away="if (!childElementOpen) { open = false }"
                    class="inline-block relative w-full text-left md:w-auto"
                    wire:key="{{ $tableName }}-column-select-button"
                >
                    <div>
                        <span class="rounded-md shadow-sm">
                            <button
                                x-on:click="open = !open"
                                type="button"
                                class="inline-flex justify-center px-4 py-2 w-full text-sm font-medium text-gray-700 bg-white rounded-md border border-gray-300 shadow-sm hover:bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600"
                                aria-haspopup="true"
                                x-bind:aria-expanded="open"
                                aria-expanded="true"
                            >
                                @lang('Columns')

                                <x-heroicon-m-chevron-down class="-mr-1 ml-2 h-5 w-5" />
                            </button>
                        </span>
                    </div>

                    <div
                        x-cloak
                        x-show="open"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 z-50 mt-2 w-full bg-white rounded-md divide-y divide-gray-100 ring-1 ring-black ring-opacity-5 shadow-lg origin-top-right md:w-48 focus:outline-none"
                    >
                        <div class="bg-white rounded-md shadow-xs dark:bg-gray-700 dark:text-white">
                            <div class="p-2" role="menu" aria-orientation="vertical"
                                 aria-labelledby="column-select-menu">
                                <div wire:key="{{ $tableName }}-columnSelect-selectAll-{{ rand(0,1000) }}">
                                    <label
                                        wire:loading.attr="disabled"
                                        class="inline-flex items-center px-2 py-1 disabled:opacity-50 disabled:cursor-wait"
                                    >
                                        <input
                                            class="text-indigo-600 transition duration-150 ease-in-out border-gray-300 rounded shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600 disabled:opacity-50 disabled:cursor-wait"
                                            wire:loading.attr="disabled" 
                                            type="checkbox"
                                            @checked($component->visibleColumnCount == $component->defaultVisibleColumnCount)
                                            @if($component->visibleColumnCount >= $component->defaultVisibleColumnCount)  wire:click="deselectAllColumns" @else wire:click="selectAllColumns" @endif
                                        >
                                        <span class="ml-2">{{ __('All Columns') }}</span>
                                    </label>
                                </div>

                                @foreach ($component->getColumns() as $column)
                                    @if ($column->isVisible() && $column->isSelectable())
                                        <div
                                            wire:key="{{ $tableName }}-columnSelect-{{ $loop->index }}"
                                        >
                                            <label
                                                wire:loading.attr="disabled"
                                                wire:target="selectedColumns"
                                                class="inline-flex items-center px-2 py-1 disabled:opacity-50 disabled:cursor-wait"
                                            >
                                                <input
                                                    class="text-indigo-600 rounded border-gray-300 shadow-sm transition duration-150 ease-in-out focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600 disabled:opacity-50 disabled:cursor-wait"
                                                    wire:model.live="selectedColumns" wire:target="selectedColumns"
                                                    wire:loading.attr="disabled" type="checkbox"
                                                    value="{{ $column->getSlug() }}" />
                                                <span class="ml-2">{{ $column->getTitle() }}</span>
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($component->paginationIsEnabled() && $component->perPageVisibilityIsEnabled())
            <div>
                <select
                    wire:model.live="perPage" id="{{ $tableName }}-perPage"
                    class="block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                >
                    @foreach ($component->getPerPageAccepted() as $item)
                        <option
                            value="{{ $item }}"
                            wire:key="{{ $tableName }}-per-page-{{ $item }}"
                        >
                            {{ $item === -1 ? __('All') : $item }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        @if ($component->hasConfigurableAreaFor('toolbar-right-end'))
            @include($component->getConfigurableAreaFor('toolbar-right-end'), $component->getParametersForConfigurableArea('toolbar-right-end'))
        @endif
    </div>
</div>

@if (
    $component->filtersAreEnabled() &&
    $component->filtersVisibilityIsEnabled() &&
    $component->hasVisibleFilters() &&
    $component->isFilterLayoutSlideDown()
)
    <div
        x-cloak
        x-show="filtersOpen"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0"
        x-transition:enter-end="transform opacity-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100"
        x-transition:leave-end="transform opacity-0"
    >
        @foreach ($component->getFiltersByRow() as $filterRowIndex => $filterRow)
            <div
                row="{{ $filterRowIndex }}"
                class="grid grid-cols-12 gap-6 px-4 md:p-0 mb-6"
                @class([
                    'col-span-12  sm:col-span-12 sm:col-span-6 sm:col-span-3 sm:col-span-1 md:col-span-12 md:col-span-6 md:col-span-3 md:col-span-1 lg:col-span-12 lg:col-span-6 lg:col-span-3 lg:col-span-1 row-start-1 row-start-2 row-start-3 row-start-4 row-start-5 row-start-6 row-start-7 row-start-8 row-start9' => true == false,
                ])
            >
                @foreach ($filterRow as $filter)
                    <div @class([
                            'space-y-1 col-span-12',
                            'sm:col-span-6 md:col-span-4 lg:col-span-2' => !$filter->hasFilterSlidedownColspan(),
                            'sm:col-span-12 md:col-span-8 lg:col-span-4' =>
                                $filter->hasFilterSlidedownColspan() &&
                                $filter->getFilterSlidedownColspan() == 2,
                            'sm:col-span-9 md:col-span-4 lg:col-span-3' =>
                                $filter->hasFilterSlidedownColspan() &&
                                $filter->getFilterSlidedownColspan() == 3,
                            ])
                         id="{{ $tableName }}-filter-{{ $filter->getKey() }}-wrapper"
                    >
                        {{ $filter->render($component->filterLayout, $tableName, $component->isTailwind(), $component->isBootstrap4(), $component->isBootstrap5()) }}
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endif
