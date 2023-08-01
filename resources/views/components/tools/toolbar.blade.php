@aware(['component', 'tableName'])

@if ($component->hasConfigurableAreaFor('before-toolbar'))
    @include($component->getConfigurableAreaFor('before-toolbar'), $component->getParametersForConfigurableArea('before-toolbar'))
@endif

@if ($component->isTailwind())
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
                    class="inline-flex justify-center items-center w-full md:w-auto px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
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
                    <input wire:model{{ $component->getSearchOptions() }}="search"
                           placeholder="{{ __('Search') }}" type="text"
                           class="block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-700 dark:text-white dark:border-gray-600 @if ($component->hasSearch()) rounded-none rounded-l-md focus:ring-0 focus:border-gray-300 @else focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md @endif" />

                    @if ($component->hasSearch())
                        <span wire:click="clearSearch"
                              class="inline-flex items-center px-3 text-gray-500 bg-gray-50 rounded-r-md border border-l-0 border-gray-300 cursor-pointer sm:text-sm dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </span>
                    @endif
                </div>
            @endif

            @if ($component->filtersAreEnabled() && $component->filtersVisibilityIsEnabled() && $component->hasVisibleFilters())
                <div x-show="!currentlyReorderingStatus" @if ($component->isFilterLayoutPopover()) x-data="{ open: false, childElementOpen: false }"
                     x-on:keydown.escape.stop="if (!childElementOpen) { open = false }"
                     x-on:mousedown.away="if (!childElementOpen) { open = false }" @endif
                     class="relative block md:inline-block text-left"
                >
                    <div>
                        <button type="button"
                                class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600"
                                @if ($component->isFilterLayoutPopover()) x-on:click="open = !open"
                                aria-haspopup="true"
                                x-bind:aria-expanded="open"
                                aria-expanded="true" @endif
                                @if ($component->isFilterLayoutSlideDown()) x-on:click="filtersOpen = !filtersOpen" @endif>
                            @lang('Filters')

                            @if ($count = $component->getFilterBadgeCount())
                                <span
                                    class="ml-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-indigo-100 text-indigo-800 capitalize dark:bg-indigo-200 dark:text-indigo-900">
                                    {{ $count }}
                                </span>
                            @endif

                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                        </button>
                    </div>

                    @if ($component->isFilterLayoutPopover())
                        <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="origin-top-left absolute left-0 mt-2 w-full md:w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none z-50 dark:bg-gray-700 dark:text-white dark:divide-gray-600"
                             role="menu" aria-orientation="vertical" aria-labelledby="filters-menu">
                            @foreach ($component->getVisibleFilters() as $filter)
                                <div class="py-1" role="none">
                                    <div class="block px-4 py-2 text-sm text-gray-700 space-y-1" role="menuitem"
                                         id="{{ $tableName }}-filter-{{ $filter->getKey() }}-wrapper">
                                        {{ $filter->render($component->filterLayout, $tableName, $component->isTailwind(), $component->isBootstrap4(), $component->isBootstrap5()) }}
                                    </div>
                                </div>
                            @endforeach

                            @if ($component->hasAppliedVisibleFiltersWithValuesThatCanBeCleared())
                                <div class="block px-4 py-3 text-sm text-gray-700 dark:text-white" role="menuitem">
                                    <button wire:click.prevent="setFilterDefaults" x-on:click="open = false"
                                            type="button"
                                            class="w-full inline-flex items-center justify-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:hover:border-gray-500">
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
                    @include(
                        $component->getConfigurableAreaFor('toolbar-left-end'),
                        $component->getParametersForConfigurableArea('toolbar-left-end'))
                </div>
            @endif
        </div>

        <div x-show="!currentlyReorderingStatus" class="md:flex md:items-center space-y-4 md:space-y-0 md:space-x-2">
            @if ($component->hasConfigurableAreaFor('toolbar-right-start'))
                @include(
                    $component->getConfigurableAreaFor('toolbar-right-start'),
                    $component->getParametersForConfigurableArea('toolbar-right-start'))
            @endif

            @if ($component->showBulkActionsDropdownAlpine())
                <div x-cloak x-show="(selectedItems.length > 0 || alwaysShowBulkActions)" class="w-full md:w-auto mb-4 md:mb-0">
                    <div x-data="{ open: false, childElementOpen: false }" @keydown.window.escape="if (!childElementOpen) { open = false }"
                         x-on:click.away="if (!childElementOpen) { open = false }"
                         class="relative inline-block text-left z-10 w-full md:w-auto">
                        <div>
                            <span class="rounded-md shadow-sm">
                                <button x-on:click="open = !open" type="button"
                                        class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600"
                                        aria-haspopup="true" x-bind:aria-expanded="open" aria-expanded="true">
                                    @lang('Bulk Actions')

                                    <svg class="-mr-1 ml-2 h-5 w-5" x-description="Heroicon name: chevron-down"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </span>
                        </div>

                        <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="origin-top-right absolute right-0 mt-2 w-full md:w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none z-50">
                            <div class="rounded-md bg-white shadow-xs dark:bg-gray-700 dark:text-white">
                                <div class="py-1" role="menu" aria-orientation="vertical">
                                    @foreach ($component->getBulkActions() as $action => $title)
                                        <button wire:click="{{ $action }}"
                                                wire:key="{{ $tableName }}-bulk-action-{{ $action }}"
                                                type="button"
                                                class="block w-full px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 flex items-center space-x-2 dark:text-white dark:hover:bg-gray-600"
                                                role="menuitem">
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
                    class="@if ($component->getColumnSelectIsHiddenOnMobile()) hidden sm:block @elseif ($component->getColumnSelectIsHiddenOnTablet()) hidden md:block @endif mb-4 w-full md:w-auto md:mb-0 md:ml-2">
                    <div x-data="{ open: false, childElementOpen: false }" @keydown.window.escape="if (!childElementOpen) { open = false }"
                         x-on:click.away="if (!childElementOpen) { open = false }"
                         class="inline-block relative w-full text-left md:w-auto"
                         wire:key="{{ $tableName }}-column-select-button">
                        <div>
                            <span class="rounded-md shadow-sm">
                                <button x-on:click="open = !open" type="button"
                                        class="inline-flex justify-center px-4 py-2 w-full text-sm font-medium text-gray-700 bg-white rounded-md border border-gray-300 shadow-sm hover:bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600"
                                        aria-haspopup="true" x-bind:aria-expanded="open" aria-expanded="true">
                                    @lang('Columns')

                                    <svg class="-mr-1 ml-2 w-5 h-5" x-description="Heroicon name: chevron-down"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </span>
                        </div>

                        <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 z-50 mt-2 w-full bg-white rounded-md divide-y divide-gray-100 ring-1 ring-black ring-opacity-5 shadow-lg origin-top-right md:w-48 focus:outline-none">
                            <div class="bg-white rounded-md shadow-xs dark:bg-gray-700 dark:text-white">
                                <div class="p-2" role="menu" aria-orientation="vertical"
                                     aria-labelledby="column-select-menu">
                                    <div>
                                        <label wire:loading.attr="disabled"
                                               class="inline-flex items-center px-2 py-1 disabled:opacity-50 disabled:cursor-wait">
                                            <input
                                                class="text-indigo-600 transition duration-150 ease-in-out border-gray-300 rounded shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600 disabled:opacity-50 disabled:cursor-wait"
                                                wire:loading.attr="disabled" type="checkbox" @if($component->allDefaultVisibleColumnsAreSelected()) checked wire:click="deselectAllColumns"  @else unchecked wire:click="selectAllColumns" @endif>
                                            <span class="ml-2">{{ __('All Columns') }}</span>
                                        </label>
                                    </div>
                                    @foreach ($component->getColumns() as $column)
                                        @if ($column->isVisible() && $column->isSelectable())
                                            <div
                                                wire:key="{{ $tableName }}-columnSelect-{{ $loop->index }}">
                                                <label wire:loading.attr="disabled" wire:target="selectedColumns"
                                                       class="inline-flex items-center px-2 py-1 disabled:opacity-50 disabled:cursor-wait">
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
                    <select wire:model.live="perPage" id="{{ $tableName }}-perPage"
                            class="block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        @foreach ($component->getPerPageAccepted() as $item)
                            <option value="{{ $item }}"
                                    wire:key="{{ $tableName }}-per-page-{{ $item }}">
                                {{ $item === -1 ? __('All') : $item }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            @if ($component->hasConfigurableAreaFor('toolbar-right-end'))
                @include(
                    $component->getConfigurableAreaFor('toolbar-right-end'),
                    $component->getParametersForConfigurableArea('toolbar-right-end'))
            @endif
        </div>
    </div>

    @if (
        $component->filtersAreEnabled() &&
            $component->filtersVisibilityIsEnabled() &&
            $component->hasVisibleFilters() &&
            $component->isFilterLayoutSlideDown())
        <div x-cloak x-show="filtersOpen" x-transition:enter="transition ease-out duration-100"
             x-transition:enter-start="transform opacity-0" x-transition:enter-end="transform opacity-100"
             x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100"
             x-transition:leave-end="transform opacity-0">

            @foreach ($component->getFiltersByRow() as $filterRowIndex => $filterRow)
                <div row="{{ $filterRowIndex }}" class="grid grid-cols-12 gap-6 px-4 md:p-0 mb-6"
                    @class([
                        'col-span-12  sm:col-span-12 sm:col-span-6 sm:col-span-3 sm:col-span-1 md:col-span-12 md:col-span-6 md:col-span-3 md:col-span-1 lg:col-span-12 lg:col-span-6 lg:col-span-3 lg:col-span-1 row-start-1 row-start-2 row-start-3 row-start-4 row-start-5 row-start-6 row-start-7 row-start-8 row-start9' =>
                            true == false,
                    ])>
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
                             id="{{ $tableName }}-filter-{{ $filter->getKey() }}-wrapper">
                             {{ $filter->render($component->filterLayout, $tableName, $component->isTailwind(), $component->isBootstrap4(), $component->isBootstrap5()) }}
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    @endif
@elseif ($component->isBootstrap())
    <div @class([
            'd-md-flex justify-content-between mb-3' => $component->isBootstrap(),
        ])
    >
        <div
            @class([
                'd-md-flex' => $component->isBootstrap(),
            ])
        >
            @if ($component->hasConfigurableAreaFor('toolbar-left-start'))
                <div x-show="!currentlyReorderingStatus">
                    @include(
                        $component->getConfigurableAreaFor('toolbar-left-start'),
                        $component->getParametersForConfigurableArea('toolbar-left-start'))
                </div>
            @endif

            <div  x-show="reorderStatus"
                @class([
                    'mr-0 mr-md-2 mb-3 mb-md-0' => $component->isBootstrap4(),
                    'me-0 me-md-2 mb-3 mb-md-0' => $component->isBootstrap5()
                ])
            >
                <button
                    x-on:click="reorderToggle()"
                    type="button"
                    @class([
                        'btn btn-default d-block w-100 d-md-inline' => $component->isBootstrap(),
                    ])
                >
                    <span x-show="currentlyReorderingStatus">
                        @lang('Done Reordering')
                    </span>
                    <span x-show="currentlyReorderingStatus !== true">
                        @lang('Reorder')
                    </span>
                </button>
            </div>

            @if ($component->searchIsEnabled() && $component->searchVisibilityIsEnabled())
                <div x-show="!currentlyReorderingStatus"
                    @class([
                            'mb-3 mb-md-0 input-group' => $component->isBootstrap(),
                    ])
                >
                    <input wire:model{{ $component->getSearchOptions() }}="search"
                           placeholder="{{ __('Search') }}" type="text"
                        @class([
                            'form-control' => $component->isBootstrap(),
                        ])
                    >

                    @if ($component->hasSearch())
                        <div
                            @class([
                                'input-group-append' => $component->isBootstrap(),
                            ])
                        >
                            <button wire:click="clearSearch"
                                    type="button"
                                @class([
                                    'btn btn-outline-secondary' => $component->isBootstrap(),
                                ])
                            >
                                <svg style="width:.75em;height:.75em" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>
            @endif

            @if ($component->filtersAreEnabled() && $component->filtersVisibilityIsEnabled() && $component->hasVisibleFilters())
                <div x-show="!currentlyReorderingStatus"
                    @class([
                        'ml-0 ml-md-2 mb-3 mb-md-0' => $component->isBootstrap4(),
                        'ms-0 ms-md-2 mb-3 mb-md-0' => $component->isBootstrap5() && $component->searchIsEnabled(),
                        'mb-3 mb-md-0' => $component->isBootstrap5() && !$component->searchIsEnabled(),
                    ])
                >
                    <div @if ($component->isFilterLayoutPopover()) x-data="{ open: false, childElementOpen: false  }"
                         x-on:keydown.escape.stop="if (!childElementOpen) { open = false }"
                         x-on:mousedown.away="if (!childElementOpen) { open = false }" @endif
                        @class([
                                'btn-group d-block d-md-inline' => $component->isBootstrap(),
                        ])
                    >
                        <div>
                            <button type="button"
                                    @class([
                                        'btn dropdown-toggle d-block w-100 d-md-inline' => $component->isBootstrap(),
                                    ])
                                    @if ($component->isFilterLayoutPopover()) x-on:click="open = !open"
                                    aria-haspopup="true"
                                    x-bind:aria-expanded="open"
                                    aria-expanded="true" @endif
                                    @if ($component->isFilterLayoutSlideDown()) x-on:click="filtersOpen = !filtersOpen" @endif>
                                @lang('Filters')

                                @if ($count = $component->getFilterBadgeCount())
                                    <span
                                        @class([
                                            'badge badge-info' => $component->isBootstrap(),
                                        ])
                                    >
                                        {{ $count }}
                                    </span>
                                @endif

                                <span
                                    @class([
                                        'caret' => $component->isBootstrap(),
                                    ])
                                ></span>
                            </button>
                        </div>

                        @if ($component->isFilterLayoutPopover())
                            <ul x-cloak
                                @class([
                                        'dropdown-menu w-100 mt-md-5' => $component->isBootstrap4(),
                                        'dropdown-menu w-100' => $component->isBootstrap5(),
                                ])
                                x-bind:class="{ 'show': open }"
                                role="menu">
                                @foreach ($component->getVisibleFilters() as $filter)
                                    <div wire:key="{{ $tableName }}-filter-{{ $filter->getKey() }}"
                                         @class([
                                             'p-2' => $component->isBootstrap(),
                                         ])
                                         id="{{ $tableName }}-filter-{{ $filter->getKey() }}-wrapper"
                                    >
                                    {{ $filter->render($component->filterLayout, $tableName, $component->isTailwind(), $component->isBootstrap4(), $component->isBootstrap5()) }}
                                    </div>
                                @endforeach

                                @if ($component->hasAppliedVisibleFiltersWithValuesThatCanBeCleared())
                                    <div
                                        @class([
                                                'dropdown-divider' => $component->isBootstrap(),
                                        ])
                                    ></div>

                                    <button wire:click.prevent="setFilterDefaults" x-on:click="open = false"
                                        @class([
                                            'dropdown-item btn text-center' => $component->isBootstrap4(),
                                            'dropdown-item text-center' => $component->isBootstrap5(),
                                        ])
                                    >
                                        @lang('Clear')
                                    </button>
                                @endif
                            </ul>
                        @endif
                    </div>
                </div>
            @endif

            @if ($component->hasConfigurableAreaFor('toolbar-left-end'))
                <div x-show="!currentlyReorderingStatus">
                    @include(
                        $component->getConfigurableAreaFor('toolbar-left-end'),
                        $component->getParametersForConfigurableArea('toolbar-left-end'))
                </div>
            @endif
        </div>

        <div x-show="!currentlyReorderingStatus"
            @class([
                'd-md-flex' => $component->isBootstrap(),
            ])
        >
            @if ($component->hasConfigurableAreaFor('toolbar-right-start'))
                @include(
                    $component->getConfigurableAreaFor('toolbar-right-start'),
                    $component->getParametersForConfigurableArea('toolbar-right-start'))
            @endif

            @if ($component->showBulkActionsDropdownAlpine())
                <div x-cloak x-show="(selectedItems.length > 0 || alwaysShowBulkActions)"
                    @class([
                        'mb-3 mb-md-0' => $component->isBootstrap(),
                    ])
                >
                    <div
                        @class([
                            'dropdown d-block d-md-inline' => $component->isBootstrap(),
                        ])
                    >
                        <button
                            @class([
                                'btn dropdown-toggle d-block w-100 d-md-inline' => $component->isBootstrap(),
                            ])
                            type="button"
                            id="{{ $tableName }}-bulkActionsDropdown" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            @lang('Bulk Actions')
                        </button>

                        <div
                            @class([
                                'dropdown-menu dropdown-menu-right w-100' => $component->isBootstrap4(),
                                'dropdown-menu dropdown-menu-end w-100' => $component->isBootstrap5(),
                            ])
                            aria-labelledby="{{ $tableName }}-bulkActionsDropdown">
                            @foreach ($component->getBulkActions() as $action => $title)
                                <a href="#" wire:click="{{ $action }}"
                                   wire:key="{{ $tableName }}-bulk-action-{{ $action }}"
                                    @class([
                                        'dropdown-item' => $component->isBootstrap(),
                                    ])
                                >
                                    {{ $title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            @if ($component->columnSelectIsEnabled())
                <div
                    @class([
                        'd-none d-sm mb-3 mb-md-0 pl-0 pl-md-2' => $component->getColumnSelectIsHiddenOnMobile() && $component->isBootstrap4(),
                        'd-none d-md-block mb-3 mb-md-0 pl-0 pl-md-2' => $component->getColumnSelectIsHiddenOnTablet() && $component->isBootstrap4(),
                        'd-none d-sm-block mb-3 mb-md-0 md-0 ms-md-2' => $component->getColumnSelectIsHiddenOnMobile() && $component->isBootstrap5(),
                        'd-none d-md-block mb-3 mb-md-0 md-0 ms-md-2' => $component->getColumnSelectIsHiddenOnTablet() && $component->isBootstrap5(),
                    ])
                >
                    <div x-data="{ open: false, childElementOpen: false }" x-on:keydown.escape.stop="if (!childElementOpen) { open = false }"
                         x-on:mousedown.away="if (!childElementOpen) { open = false }"
                         @class([
                             'dropdown d-block d-md-inline' => $component->isBootstrap(),
                         ])
                         wire:key="{{ $tableName }}-column-select-button">
                        <button x-on:click="open = !open"
                                @class([
                                    'btn dropdown-toggle d-block w-100 d-md-inline' => $component->isBootstrap(),
                                ])
                                type="button" id="{{ $tableName }}-columnSelect" aria-haspopup="true"
                                x-bind:aria-expanded="open">
                            @lang('Columns')
                        </button>

                        <div
                            @class([
                                'dropdown-menu dropdown-menu-right w-100 mt-0 mt-md-3' => $component->isBootstrap4(),
                                'dropdown-menu dropdown-menu-end w-100' => $component->isBootstrap5(),
                            ])
                            x-bind:class="{ 'show': open }"
                            aria-labelledby="columnSelect-{{ $tableName }}"
                        >

                            @if($component->isBootstrap4())
                                <div>
                                    <label wire:loading.attr="disabled" class="px-2 mb-1">
                                        <input
                                            wire:loading.attr="disabled" type="checkbox" @if($component->allDefaultVisibleColumnsAreSelected()) checked wire:click="deselectAllColumns"  @else unchecked wire:click="selectAllColumns" @endif />
                                        <span class="ml-2">{{ __('All Columns') }}</span>
                                    </label>
                                </div>
                            @elseif($component->isBootstrap5())
                                <div class="form-check ms-2">
                                    <input
                                        wire:loading.attr="disabled"
                                        type="checkbox"
                                        class="form-check-input"
                                        @if($component->allDefaultVisibleColumnsAreSelected()) checked wire:click="deselectAllColumns"  @else unchecked wire:click="selectAllColumns" @endif
                                    />
                                    <label wire:loading.attr="disabled" class="form-check-label">
                                        {{ __('All Columns') }}
                                    </label>
                                </div>
                            @endif

                            @foreach ($component->getColumns() as $column)
                                @if ($column->isVisible() && $column->isSelectable())
                                    <div wire:key="{{ $tableName }}-columnSelect-{{ $loop->index }}"
                                        @class([
                                            'form-check ms-2' => $component->isBootstrap5(),
                                        ])
                                    >
                                        @if ($component->isBootstrap4())
                                            <label
                                                wire:loading.attr="disabled"
                                                wire:target="selectedColumns"
                                                class="px-2 {{ $loop->last ? 'mb-0' : 'mb-1' }}"
                                            >
                                                <input wire:model.live="selectedColumns"
                                                       wire:target="selectedColumns"
                                                       wire:loading.attr="disabled" type="checkbox"
                                                       value="{{ $column->getSlug() }}"
                                                />
                                                <span class="ml-2">
                                                {{ $column->getTitle() }}
                                            </span>
                                            </label>
                                        @elseif($component->isBootstrap5())
                                            <input
                                                wire:model.live="selectedColumns"
                                                wire:target="selectedColumns"
                                                wire:loading.attr="disabled"
                                                type="checkbox"
                                                class="form-check-input"
                                                value="{{ $column->getSlug() }}"
                                            />
                                            <label
                                                wire:loading.attr="disabled"
                                                wire:target="selectedColumns"
                                                class="{{ $loop->last ? 'mb-0' : 'mb-1' }} form-check-label"
                                            >
                                                {{ $column->getTitle() }}
                                            </label>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            @if ($component->paginationIsEnabled() && $component->perPageVisibilityIsEnabled())
                <div
                    @class([
                        'ml-0 ml-md-2' => $component->isBootstrap4(),
                        'ms-0 ms-md-2' => $component->isBootstrap5(),
                    ])
                >
                    <select wire:model.live="perPage" id="{{ $tableName }}-perPage"
                        @class([
                            'form-control' => $component->isBootstrap4(),
                            'form-select' => $component->isBootstrap5(),
                        ])
                    >
                        @foreach ($component->getPerPageAccepted() as $item)
                            <option value="{{ $item }}"
                                    wire:key="{{ $tableName }}-per-page-{{ $item }}">
                                {{ $item === -1 ? __('All') : $item }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            @if ($component->hasConfigurableAreaFor('toolbar-right-end'))
                <div x-show="!currentlyReorderingStatus">
                    @include(
                        $component->getConfigurableAreaFor('toolbar-right-end'),
                        $component->getParametersForConfigurableArea('toolbar-right-end'))
                </div>
            @endif
        </div>
    </div>

    @if (
        $component->filtersAreEnabled() &&
            $component->filtersVisibilityIsEnabled() &&
            $component->hasVisibleFilters() &&
            $component->isFilterLayoutSlideDown())
        <div x-show="!currentlyReorderingStatus">
            <div x-cloak x-show="filtersOpen">
                <div
                    @class([
                        'container' => $component->isBootstrap(),
                    ])
                >
                    @foreach ($component->getFiltersByRow() as $filterRowIndex => $filterRow)
                        <div
                            @class([
                                'row col-12' => $component->isBootstrap(),
                            ])
                            row="{{ $filterRowIndex }}"
                        >
                            @foreach ($filterRow as $filter)
                                <div @class([
                                    'space-y-1 mb-4',
                                    'col-12 col-sm-9 col-md-6 col-lg-3' => !$filter->hasFilterSlidedownColspan(),
                                    'col-12 col-sm-6 col-md-6 col-lg-3' =>
                                        $filter->hasFilterSlidedownColspan() &&
                                        $filter->getFilterSlidedownColspan() == 2,
                                    'col-12 col-sm-3 col-md-3 col-lg-3' =>
                                        $filter->hasFilterSlidedownColspan() &&
                                        $filter->getFilterSlidedownColspan() == 3,
                                    'col-12 col-sm-1 col-md-1 col-lg-1' =>
                                        $filter->hasFilterSlidedownColspan() &&
                                        $filter->getFilterSlidedownColspan() == 4,
                                ])
                                     id="{{ $tableName }}-filter-{{ $filter->getKey() }}-wrapper">
                                     {{ $filter->render($component->filterLayout, $tableName, $component->isTailwind(), $component->isBootstrap4(), $component->isBootstrap5()) }}
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endif

@if ($component->hasConfigurableAreaFor('after-toolbar'))
    <div x-show="!currentlyReorderingStatus" >
        @include(
            $component->getConfigurableAreaFor('after-toolbar'),
            $component->getParametersForConfigurableArea('after-toolbar'))
    </div>
@endif
