@aware(['component', 'tableName'])

<div x-show="!currentlyReorderingStatus" class="flex rounded-md shadow-sm">
                <input
                    wire:model{{ $component->getSearchOptions() }}="search"
                    placeholder="{{ $component->getSearchPlaceholder() }}"
                    type="text"
                    {{ 
                        $attributes->merge($component->getSearchFieldAttributes())
                        ->class(['block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-700 dark:text-white dark:border-gray-600 @if ($component->hasSearch()) rounded-none rounded-l-md focus:ring-0 focus:border-gray-300 @else focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md @endif' => $component->getSearchFieldAttributes()['default'] ?? true])
                        ->except('default') 
                    }}

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
