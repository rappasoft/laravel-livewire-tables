<div @class([
    'd-md-flex justify-content-between mb-3' => $component->isBootstrap(),
])>
    <div @class([
        'd-md-flex' => $component->isBootstrap(),
    ])>
        @if ($component->hasConfigurableAreaFor('toolbar-left-start'))
            <div x-show="!currentlyReorderingStatus">
                @include($component->getConfigurableAreaFor('toolbar-left-start'), $component->getParametersForConfigurableArea('toolbar-left-start'))
            </div>
        @endif

        <div
            x-show="reorderStatus"
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
            <div
                x-show="!currentlyReorderingStatus"
                @class([
                    'mb-3 mb-md-0 input-group' => $component->isBootstrap(),
                ])
            >
                <input
                    wire:model{{ $component->getSearchOptions() }}="search"
                    placeholder="{{ $component->getSearchPlaceholder() }}"
                    type="text"
                    {{ 
                        $attributes->merge($component->getSearchFieldAttributes())
                        ->class(['form-control' => $component->getSearchFieldAttributes()['default'] ?? true])
                        ->except('default') 
                    }}
                >

                @if ($component->hasSearch())
                    <div @class([
                            'input-group-append' => $component->isBootstrap(),
                        ])>
                        <button
                            wire:click="clearSearch"
                            type="button"
                            @class([
                                'btn btn-outline-secondary' => $component->isBootstrap(),
                            ])
                        >
                            <x-heroicon-m-x-mark style="width:.75em;height:.75em" />
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
                <div
                    @if ($component->isFilterLayoutPopover())
                        x-data="{ open: false, childElementOpen: false  }"
                        x-on:keydown.escape.stop="if (!childElementOpen) { open = false }"
                        x-on:mousedown.away="if (!childElementOpen) { open = false }"
                    @endif
                    @class([
                        'btn-group d-block d-md-inline' => $component->isBootstrap(),
                    ])
                >
                    <div>
                        <button
                            type="button"
                            @class([
                                'btn dropdown-toggle d-block w-100 d-md-inline' => $component->isBootstrap(),
                            ])
                            @if ($component->isFilterLayoutPopover()) x-on:click="open = !open"
                                aria-haspopup="true"
                                x-bind:aria-expanded="open"
                                aria-expanded="true"
                            @endif
                            @if ($component->isFilterLayoutSlideDown()) x-on:click="filtersOpen = !filtersOpen" @endif
                        >
                            @lang('Filters')

                            @if ($count = $component->getFilterBadgeCount())
                                <span @class([
                                        'badge badge-info' => $component->isBootstrap(),
                                    ])>
                                    {{ $count }}
                                </span>
                            @endif

                            <span @class([
                                'caret' => $component->isBootstrap(),
                            ])></span>
                        </button>
                    </div>

                    @if ($component->isFilterLayoutPopover())
                        <ul
                            x-cloak
                            @class([
                                'dropdown-menu w-100 mt-md-5' => $component->isBootstrap4(),
                                'dropdown-menu w-100' => $component->isBootstrap5(),
                            ])
                            x-bind:class="{ 'show': open }"
                            role="menu"
                        >
                            @foreach ($component->getVisibleFilters() as $filter)
                                <div
                                    wire:key="{{ $tableName }}-filter-{{ $filter->getKey() }}-toolbar"
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

                                <button
                                    wire:click.prevent="setFilterDefaults" x-on:click="open = false"
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
                @include($component->getConfigurableAreaFor('toolbar-left-end'), $component->getParametersForConfigurableArea('toolbar-left-end'))
            </div>
        @endif
    </div>

    <div
        x-show="!currentlyReorderingStatus"
        @class([
            'd-md-flex' => $component->isBootstrap(),
        ])
    >
        @if ($component->hasConfigurableAreaFor('toolbar-right-start'))
            @include($component->getConfigurableAreaFor('toolbar-right-start'), $component->getParametersForConfigurableArea('toolbar-right-start'))
        @endif

        @if ($component->showBulkActionsDropdownAlpine())
            <div
                x-cloak
                x-show="(selectedItems.length > 0 || alwaysShowBulkActions)"
                @class([
                    'mb-3 mb-md-0' => $component->isBootstrap(),
                ])
            >
                <div @class([
                    'dropdown d-block d-md-inline' => $component->isBootstrap(),
                ])>
                    <button
                        @class([
                            'btn dropdown-toggle d-block w-100 d-md-inline' => $component->isBootstrap(),
                        ])
                        type="button"
                        id="{{ $tableName }}-bulkActionsDropdown" data-toggle="dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        @lang('Bulk Actions')
                    </button>

                    <div
                        @class([
                            'dropdown-menu dropdown-menu-right w-100' => $component->isBootstrap4(),
                            'dropdown-menu dropdown-menu-end w-100' => $component->isBootstrap5(),
                        ])
                        aria-labelledby="{{ $tableName }}-bulkActionsDropdown"
                    >
                        @foreach ($component->getBulkActions() as $action => $title)
                            <a
                                href="#"
                                wire:click="{{ $action }}"
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
                <div
                    x-data="{ open: false, childElementOpen: false }"
                    x-on:keydown.escape.stop="if (!childElementOpen) { open = false }"
                    x-on:mousedown.away="if (!childElementOpen) { open = false }"
                    @class([
                        'dropdown d-block d-md-inline' => $component->isBootstrap(),
                    ])
                    wire:key="{{ $tableName }}-column-select-button"
                >
                    <button
                        x-on:click="open = !open"
                        @class([
                            'btn dropdown-toggle d-block w-100 d-md-inline' => $component->isBootstrap(),
                        ])
                        type="button" id="{{ $tableName }}-columnSelect" aria-haspopup="true"
                        x-bind:aria-expanded="open"
                    >
                        @lang('Columns')
                    </button>

                    <div
                        x-bind:class="{ 'show': open }"
                        @class([
                            'dropdown-menu dropdown-menu-right w-100 mt-0 mt-md-3' => $component->isBootstrap4(),
                            'dropdown-menu dropdown-menu-end w-100' => $component->isBootstrap5(),
                        ])
                        aria-labelledby="columnSelect-{{ $tableName }}"
                    >
                        @if($component->isBootstrap4())
                            <div wire:key="{{ $tableName }}-columnSelect-selectAll-{{ rand(0,1000) }}">
                                <label wire:loading.attr="disabled" class="px-2 mb-1">
                                    <input
                                        wire:loading.attr="disabled"
                                        type="checkbox"
                                        @if($component->getSelectableSelectedColumns()->count() == $component->getSelectableColumns()->count()) checked wire:click="deselectAllColumns" @else unchecked wire:click="selectAllColumns" @endif
                                    />

                                    <span class="ml-2">{{ __('All Columns') }}</span>
                                </label>
                            </div>
                        @elseif($component->isBootstrap5())
                            <div class="form-check ms-2" wire:key="{{ $tableName }}-columnSelect-selectAll-{{ rand(0,1000) }}">
                                <input
                                    wire:loading.attr="disabled"
                                    type="checkbox"
                                    class="form-check-input"
                                    @if($component->getSelectableSelectedColumns()->count() == $component->getSelectableColumns()->count()) checked wire:click="deselectAllColumns" @else unchecked wire:click="selectAllColumns" @endif
                                />

                                <label wire:loading.attr="disabled" class="form-check-label">
                                    {{ __('All Columns') }}
                                </label>
                            </div>
                        @endif

                        @foreach ($component->getColumnsForColumnSelect() as $columnSlug => $columnTitle)
                                <div
                                    wire:key="{{ $tableName }}-columnSelect-{{ $loop->index }}"
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
                                            <input
                                                wire:model.live="selectedColumns"
                                                wire:target="selectedColumns"
                                                wire:loading.attr="disabled" type="checkbox"
                                                value="{{ $columnSlug }}"
                                            />
                                            <span class="ml-2">
                                                {{ $columnTitle }}
                                            </span>
                                        </label>
                                    @elseif($component->isBootstrap5())
                                        <input
                                            wire:model.live="selectedColumns"
                                            wire:target="selectedColumns"
                                            wire:loading.attr="disabled"
                                            type="checkbox"
                                            class="form-check-input"
                                            value="{{ $columnSlug }}"
                                        />
                                        <label
                                            wire:loading.attr="disabled"
                                            wire:target="selectedColumns"
                                            class="{{ $loop->last ? 'mb-0' : 'mb-1' }} form-check-label"
                                        >
                                            {{ $columnTitle }}
                                        </label>
                                    @endif
                                </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if ($component->paginationIsEnabled() && $component->perPageVisibilityIsEnabled())
            <div @class([
                'ml-0 ml-md-2' => $component->isBootstrap4(),
                'ms-0 ms-md-2' => $component->isBootstrap5(),
            ])>
                <select
                    wire:model.live="perPage"
                    id="{{ $tableName }}-perPage"
                    @class([
                        'form-control' => $component->isBootstrap4(),
                        'form-select' => $component->isBootstrap5(),
                    ])
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
            <div x-show="!currentlyReorderingStatus">
                @include($component->getConfigurableAreaFor('toolbar-right-end'), $component->getParametersForConfigurableArea('toolbar-right-end'))
            </div>
        @endif
    </div>
</div>

@if (
    $component->filtersAreEnabled() &&
    $component->filtersVisibilityIsEnabled() &&
    $component->hasVisibleFilters() &&
    $component->isFilterLayoutSlideDown()
)
    <div x-show="!currentlyReorderingStatus">
        <div x-cloak x-show="filtersOpen">
            <div @class([
                'container' => $component->isBootstrap(),
            ])>
                @foreach ($component->getFiltersByRow() as $filterRowIndex => $filterRow)
                    <div
                        @class([
                            'row col-12' => $component->isBootstrap(),
                        ])
                        row="{{ $filterRowIndex }}"
                    >
                        @foreach ($filterRow as $filter)
                            <div
                                @class([
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
                                id="{{ $tableName }}-filter-{{ $filter->getKey() }}-wrapper"
                            >
                                {{ $filter->render($component->filterLayout, $tableName, $component->isTailwind(), $component->isBootstrap4(), $component->isBootstrap5()) }}
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
