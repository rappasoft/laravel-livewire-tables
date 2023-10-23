@aware(['component', 'tableName'])
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
                <x-livewire-tables::tools.toolbar.items.tw.filter-popover />

                @endif
            </div>
