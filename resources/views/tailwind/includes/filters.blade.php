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

                @if (count($this->getFiltersWithoutSearch()))
                    <span class="ml-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-indigo-100 text-indigo-800 capitalize">
                       {{ count($this->getFiltersWithoutSearch()) }}
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
                                        wire:key="filter-{{ $key }}"
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

            @if (count($this->getFiltersWithoutSearch()))
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
