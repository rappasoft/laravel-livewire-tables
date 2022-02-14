@if ($columnSelect)
    <div class="mb-4 w-full md:w-auto md:mb-0 md:ml-2">
        <div
            x-data="{ open: false }"
            @keydown.window.escape="open = false"
            x-on:click.away="open = false"
            class="inline-block relative w-full text-left md:w-auto"
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

                        <svg class="-mr-1 ml-2 w-5 h-5" x-description="Heroicon name: chevron-down" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
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
                class="absolute right-0 z-50 mt-2 w-full bg-white rounded-md divide-y divide-gray-100 ring-1 ring-black ring-opacity-5 shadow-lg origin-top-right md:w-48 focus:outline-none"
            >
                <div class="bg-white rounded-md shadow-xs dark:bg-gray-700 dark:text-white">
                    <div class="p-2" role="menu" aria-orientation="vertical">
                        @foreach($columns as $column)
                            @if ($column->isVisible() && $column->isSelectable())
                                <div wire:key="columnSelect-{{ $loop->index }}">
                                    <label
                                        wire:loading.attr="disabled"
                                        wire:target="columnSelectEnabled"
                                        class="inline-flex items-center px-2 py-1 disabled:opacity-50 disabled:cursor-wait"
                                    >
                                        <input
                                            class="text-indigo-600 rounded border-gray-300 shadow-sm transition duration-150 ease-in-out focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600 disabled:opacity-50 disabled:cursor-wait"
                                            wire:model="columnSelectEnabled"
                                            wire:target="columnSelectEnabled"
                                            wire:loading.attr="disabled"
                                            type="checkbox"
                                            value="{{ $column->column() }}"
                                        />
                                        <span class="ml-2">{{ $column->text() }}</span>
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
