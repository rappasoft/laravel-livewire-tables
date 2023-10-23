@aware(['component', 'tableName'])
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

                                        @if(in_array($action, $component->getBulkActionConfirms()))
                                        wire:confirm="{{ $component->getBulkActionConfirmMessage($action) }}"
                                        @endif
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
