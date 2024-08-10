@aware(['component', 'tableName','isTailwind', 'isBootstrap'])

<div 
    @class([
        'mb-3 mb-md-0 input-group' => $isBootstrap,
        'flex rounded-md shadow-sm' => $isTailwind,
    ])>
        <input
            wire:model{{ $component->getSearchOptions() }}="search"
            placeholder="{{ $component->getSearchPlaceholder() }}"
            type="text"
            {{ 
                $attributes->merge($component->getSearchFieldAttributes())
                ->class([
                    'block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-700 dark:text-white dark:border-gray-600 rounded-none rounded-l-md focus:ring-0 focus:border-gray-300' => $isTailwind && $component->hasSearch() && $component->getSearchFieldAttributes()['default'] ?? true,
                    'block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-700 dark:text-white dark:border-gray-600 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50' => $isTailwind && !$component->hasSearch() && $component->getSearchFieldAttributes()['default'] ?? true,
                    'form-control' => $isBootstrap && $component->getSearchFieldAttributes()['default'] ?? true,
                ])
                ->except('default') 
            }}

        />

        @if ($component->hasSearch())
        <div @class([
                    'd-inline-flex h-100 align-items-center ' => $isBootstrap,
                ])>
                <div
                    wire:click="clearSearch"

                    @class([
                            'btn btn-outline-secondary d-inline-flex h-100 align-items-center' => $isBootstrap,
                            'inline-flex h-full items-center px-3 text-gray-500 bg-gray-50 rounded-r-md border border-l-0 border-gray-300 cursor-pointer sm:text-sm dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600' => $isTailwind,
                        ])
                >
                @if($isTailwind)
                <x-heroicon-m-x-mark class='w-4 h-4' />
                @else
                <x-heroicon-m-x-mark class="laravel-livewire-tables-btn-smaller" />
                @endif
                    </div>
            </div>
        @endif


</div>
