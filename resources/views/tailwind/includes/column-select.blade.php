@if ($columnSelect)
    <div class="w-full md:w-auto mb-4 md:mb-0 md:ml-2">
        <div
            x-data="{ open: false }"
            @keydown.window.escape="open = false"
            x-on:click.away="open = false"
            class="relative inline-block text-left w-full md:w-auto"
        >
            <div>
                <span class="rounded-md shadow-sm">
                    <button
                        x-on:click="open = !open"
                        type="button"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-indigo-300 focus:shadow-outline-indigo active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150"
                        id="column-select-menu"
                        aria-haspopup="true"
                        x-bind:aria-expanded="open"
                        aria-expanded="true"
                    >
                        @lang('Columns')

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
                class="origin-top-right absolute right-0 mt-2 w-full md:w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none z-50"
            >
                <div class="rounded-md bg-white shadow-xs">
                    <div class="p-2" role="menu" aria-orientation="vertical" aria-labelledby="column-select-menu">
                        @foreach($columns as $column)
                            @if ($column->isVisible() && $column->isSelectable())
                                <div wire:key="columnSelect-{{ $loop->index }}">
                                    <label
                                        wire:loading.attr="disabled"
                                        wire:target="columnSelectEnabled"
                                        class="px-2 py-1 inline-flex items-center disabled:opacity-50 disabled:cursor-wait"
                                    >
                                        <input
                                            class="disabled:opacity-50 disabled:cursor-wait"
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
