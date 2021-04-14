<div
    @if (is_numeric($refresh)) wire:poll.{{ $refresh }}ms @elseif(is_string($refresh)) wire:poll="{{ $refresh }}" @endif
    class="flex-col space-y-4"
>
    @if ($showSorting && count($sorts))
        <div wire:key="sort-badges" class="p-6 md:p-0">
            <small class="text-gray-700">@lang('Applied Sorting'):</small>

            @foreach($sorts as $col => $dir)
                <span
                    wire:key="sort-{{ $col }}"
                    class="inline-flex items-center py-0.5 pl-2 pr-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-700"
                >
                    {{ $sortNames[$col] ?? ucwords(strtr($col, ['_' => ' ', '-' => ' '])) }}: {{ $dir === 'asc' ? 'A-Z' : 'Z-A' }}

                    <button
                        wire:click="removeSort('{{ $col }}')"
                        type="button"
                        class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-primary-400 hover:bg-primary-200 hover:text-primary-500 focus:outline-none focus:bg-primary-500 focus:text-white"
                    >
                        <span class="sr-only">@lang('Remove sort option')</span>
                        <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                            <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
                        </svg>
                    </button>
                </span>
            @endforeach

            <button
                wire:click.prevent="resetSorts"
                class="focus:outline-none active:outline-none"
            >
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                    @lang('Clear')
                </span>
            </button>
        </div>
    @endif

    @if ($showFilters && count(array_filter($filters)) && !(count(array_filter($filters)) === 1 && isset($filters['search'])))
        <div wire:key="filter-badges" class="p-6 md:p-0">
            <small class="text-gray-700">@lang('Applied Filters'):</small>

            @foreach($filters as $key => $value)
                @if ($key !== 'search' && strlen($value))
                    <span
                        wire:key="filter-{{ $key }}"
                        class="inline-flex items-center py-0.5 pl-2 pr-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-700"
                    >
                        {{ $filterNames[$key] ?? ucwords(strtr($key, ['_' => ' ', '-' => ' '])) }}: {{ ucwords(strtr($value, ['_' => ' ', '-' => ' '])) }}

                        <button
                            wire:click="removeFilter('{{ $key }}')"
                            type="button"
                            class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-primary-400 hover:bg-primary-200 hover:text-primary-500 focus:outline-none focus:bg-primary-500 focus:text-white"
                        >
                            <span class="sr-only">@lang('Remove sort option')</span>
                            <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                                <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
                            </svg>
                        </button>
                    </span>
                @endif
            @endforeach

            <button class="focus:outline-none active:outline-none" wire:click.prevent="resetFilters">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                    @lang('Clear')
                </span>
            </button>
        </div>
    @endif

    <div class="md:flex md:justify-between p-6 md:p-0">
        <div class="w-full mb-4 md:mb-0 md:w-2/4 md:flex space-y-4 md:space-y-0 md:space-x-4">
            @if ($showSearch)
                <div class="flex rounded-md shadow-sm">
                    <input
                        wire:model.debounce.250ms="filters.search"
                        placeholder="{{ __('Search') }}"
                        type="text"
                        class="flex-1 shadow-sm border-cool-gray-300 block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:outline-none focus:border-indigo-300 focus:shadow-outline-indigo @if (isset($filters['search']) && strlen($filters['search'])) rounded-none rounded-l-md @else rounded-md @endif"
                    />

                    @if (isset($filters['search']) && strlen($filters['search']))
                        <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                            <svg wire:click="$set('filters.search', null)" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </span>
                    @endif
                </div>
            @endif

            @if ($filtersView || count($customFilters))
                <div
                    x-data="{ open: false }"
                    @keydown.escape.stop="open = false"
                    @click.away="open = false"
                    class="relative block md:inline-block text-left"
                >
                    <div>
                        <button
                            type="button"
                            class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:border-indigo-300 focus:shadow-outline-indigo" id="filters-menu" @click="open = !open" aria-haspopup="true" x-bind:aria-expanded="open" aria-expanded="true">
                            @lang('Filters')

                            @if (count(array_filter($filters)) && !(count(array_filter($filters)) === 1 && isset($filters['search'])))
                                <span class="ml-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-indigo-100 text-indigo-800 capitalize">
                                   {{ isset($filters['search']) ? count(array_filter($filters)) - 1 : count(array_filter($filters)) }}
                                </span>
                            @endif

                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                        </button>
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
                        class="origin-top-right absolute right-0 mt-2 w-full md:w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none z-50"
                        role="menu"
                        aria-orientation="vertical"
                        aria-labelledby="filters-menu"
                    >
                        @if ($filtersView)
                            @include($filtersView)
                        @elseif (count($customFilters))
                            @foreach ($customFilters as $key => $filter)
                                <div class="py-1" role="none">
                                    <div class="block px-4 py-2 text-sm text-gray-700" role="menuitem">
                                        @if ($filter->isSelect())
                                            <label for="filter-{{ $key }}" class="block text-sm font-medium leading-5 text-gray-700">
                                                {{ $filter->name() }}
                                            </label>

                                            <div class="mt-1 relative rounded-md shadow-sm">
                                                <select
                                                    wire:model="filters.{{ $key }}"
                                                    id="filter-{{ $key }}"
                                                    class="rounded-md shadow-sm block w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:border-indigo-300 focus:shadow-outline-indigo sm:text-sm sm:leading-5"
                                                >
                                                    @foreach($filter->options() as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        @if (count(array_filter($filters)) && !(count(array_filter($filters)) === 1 && isset($filters['search'])))
                            <div class="py-1" role="none">
                                <div class="block px-4 py-2 text-sm text-gray-700" role="menuitem">
                                    <button
                                        wire:click.prevent="resetFilters"
                                        type="button"
                                        class="w-full inline-flex items-center justify-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    >
                                        @lang('Clear')
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <div class="md:space-x-2 md:flex md:items-center">
            @if (count($bulkActions))
                <div class="w-full md:w-auto mb-4 md:mb-0">
                    <div
                        x-data="{ open: false }"
                        @keydown.window.escape="open = false"
                        @click.away="open = false"
                        class="relative inline-block text-left z-10 w-full md:w-auto"
                    >
                        <div>
                            <span class="rounded-md shadow-sm">
                                <button
                                    @click="open = !open"
                                    type="button"
                                    class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-primary-300 focus:shadow-outline-primary active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150"
                                    id="options-menu"
                                    aria-haspopup="true"
                                    x-bind:aria-expanded="open"
                                    aria-expanded="true"
                                >
                                    {{ __('Bulk Actions') }}

                                    <svg class="-mr-1 ml-2 h-5 w-5" x-description="Heroicon name: chevron-down" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
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
                            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg z-50"
                        >
                            <div class="rounded-md bg-white shadow-xs">
                                <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                    @foreach($bulkActions as $action => $title)
                                        <button wire:click="{{ $action }}" type="button" class="block w-full px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 flex items-center space-x-2" role="menuitem">
                                            <span>{{ $title }}</span>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="w-full md:w-auto">
                @if ($showPerPage)
                    <select
                        wire:model="perPage"
                        id="perPage"
                        class="rounded-md shadow-sm block w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:border-indigo-300 focus:shadow-outline-indigo sm:text-sm sm:leading-5"
                    >
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                @endif
            </div>
        </div>
    </div>

    <x-livewire-tables::table>
        <x-slot name="head">
            @if (count($bulkActions))
                <x-livewire-tables::table.heading class="pr-0 w-8 hidden md:table-cell">
                    <div class="flex rounded-md shadow-sm">
                        <input
                            wire:model="selectPage"
                            type="checkbox"
                            class="rounded-md shadow-sm border-cool-gray-300 block transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                        />
                    </div>
                </x-livewire-tables::table.heading>
            @endif

            @foreach($columns as $column)
                @if ($column->isBlank())
                    <x-livewire-tables::table.heading />
                @else
                    <x-livewire-tables::table.heading
                        :sortable="$column->isSortable()"
                        :multi-column="$column->isMultiColumn()"
                        :column="$column->column()"
                        :direction="$column->column() ? $sorts[$column->column()] ?? null : null"
                        :text="$column->text() ?? ''"
                        :class="$column->class() ?? ''"
                    />
                @endif
            @endforeach
        </x-slot>

        <x-slot name="body">
            @if (count($bulkActions) && $selectPage && $rows->total() > $rows->count())
                <x-livewire-tables::table.row wire:key="row-message" class="bg-primary-50">
                    <x-livewire-tables::table.cell colspan="8">
                        @unless ($selectAll)
                            <div>
                                <span>{!! __('You have selected <strong>:count</strong> users, do you want to select all <strong>:total</strong>?', ['count' => $rows->count(), 'total' => number_format($rows->total())]) !!}</span>

                                <button
                                    wire:click="selectAll"
                                    type="button"
                                    class="ml-1 text-blue-600 underline text-cool-gray-700 text-sm leading-5 font-medium focus:outline-none focus:text-cool-gray-800 focus:underline transition duration-150 ease-in-out"
                                >
                                    @lang('Select All')
                                </button>
                            </div>
                        @else
                            <span>
                                {!! __('You are currently selecting all <strong>:total</strong> users.', ['total' => number_format($rows->total())]) !!}

                                <button
                                    wire:click="resetBulk"
                                    type="button"
                                    class="ml-1 text-blue-600 underline text-cool-gray-700 text-sm leading-5 font-medium focus:outline-none focus:text-cool-gray-800 focus:underline transition duration-150 ease-in-out"
                                >
                                    @lang('Unselect All')
                                </button>
                            </span>
                        @endif
                    </x-livewire-tables::table.cell>
                </x-livewire-tables::table.row>
            @endif

            @forelse ($rows as $index => $row)
                <x-livewire-tables::table.row
                    wire:loading.class.delay="opacity-50"
                    wire:key="table-row-{{ $row->getKey() }}"
                    class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}"
                >
                    @if (count($bulkActions))
                        <x-livewire-tables::table.cell class="pr-0 hidden md:table-cell">
                            <div class="flex rounded-md shadow-sm">
                                <input
                                    wire:model="selected"
                                    value="{{ $row->getKey() }}"
                                    type="checkbox"
                                    class="rounded-md shadow-sm border-cool-gray-300 block transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                />
                            </div>
                        </x-livewire-tables::table.cell>
                    @endif

                    @include($rowsView, ['row' => $row])
                </x-livewire-tables::table.row>
            @empty
                <x-livewire-tables::table.row>
                    <x-livewire-tables::table.cell :colspan="count($bulkActions) ? count($columns) + 1 : count($columns)">
                        <div class="flex justify-center items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-cool-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>

                            <span class="font-medium py-8 text-cool-gray-400 text-xl">@lang('No items found. Try narrowing your search.')</span>
                        </div>
                    </x-livewire-tables::table.cell>
                </x-livewire-tables::table.row>
            @endforelse
        </x-slot>
    </x-livewire-tables::table>

    @if ($showPagination)
        <div class="p-6 md:p-0">
            {{ $rows->links() }}
        </div>
    @endif
</div>
