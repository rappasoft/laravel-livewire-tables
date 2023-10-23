@aware(['component', 'tableName'])

<div x-show="!currentlyReorderingStatus"
    @class([
        'mb-3 mb-md-0 input-group' => $component->isBootstrap(),
        'flex rounded-md shadow-sm' => $component->isTailwind(),
    ])>
                <input
                    wire:model{{ $component->getSearchOptions() }}="search"
                    placeholder="{{ $component->getSearchPlaceholder() }}"
                    type="text"
                    {{ 
                        $attributes->merge($component->getSearchFieldAttributes())
                        ->class([
                            'block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-700 dark:text-white dark:border-gray-600 @if ($component->hasSearch()) rounded-none rounded-l-md focus:ring-0 focus:border-gray-300 @else focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md @endif' => $component->isTailwind() && $component->getSearchFieldAttributes()['default'] ?? true,
                            'form-control' => $component->isBootstrap() && $component->getSearchFieldAttributes()['default'] ?? true,
                        ])
                        ->except('default') 
                    }}

                />

                @if ($component->hasSearch())
                    <span
                        wire:click="clearSearch"

                        @class([
                                'btn btn-outline-secondary' => $component->isBootstrap(),
                                'inline-flex items-center px-3 text-gray-500 bg-gray-50 rounded-r-md border border-l-0 border-gray-300 cursor-pointer sm:text-sm dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600' => $component->isTailwind(),
                            ])
                    >
                        <x-heroicon-m-x-mark 
                            @class([
                                'w-4 h-4' => $component->isTailwind(),
                            ])
                            @style([
                                'width:.75em;height:.75em' => $component->isBootstrap(),
                            ])                        
                        />
                    </span>
                @endif
            </div>
