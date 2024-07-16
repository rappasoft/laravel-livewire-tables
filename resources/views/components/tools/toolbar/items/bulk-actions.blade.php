@aware(['component', 'tableName'])
<div
    x-data="{ open: false, childElementOpen: false, isTailwind: @js($component->isTailwind()), isBootstrap: @js($component->isBootstrap()) }"
    x-cloak x-show="(selectedItems.length > 0 || hideBulkActionsWhenEmpty == false)"
    @class([
        'mb-3 mb-md-0' => $component->isBootstrap(),
        'w-full md:w-auto mb-4 md:mb-0' => $component->isTailwind(),
    ])
>
    <div @class([
            'dropdown d-block d-md-inline' => $component->isBootstrap(),
            'relative inline-block text-left z-10 w-full md:w-auto' => $component->isTailwind(),
        ])
    >
        <button
            {{ 
                $attributes->merge($this->getBulkActionsButtonAttributes)
                ->class([
                    'btn dropdown-toggle d-block d-md-inline' => $component->isBootstrap() && $this->getBulkActionsButtonAttributes['default-styling'] ?? true,
                    'border-gray-300 bg-white text-gray-700 hover:bg-gray-50 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600' => $component->isTailwind()  && $this->getBulkActionsButtonAttributes['default-colors'] ?? true,
                    'inline-flex justify-center w-full rounded-md border shadow-sm px-4 py-2 text-sm font-medium focus:ring focus:ring-opacity-50' => $component->isTailwind()  && $this->getBulkActionsButtonAttributes['default-styling'] ?? true,

                ])
                ->except('default') 
            }}
            type="button"
            id="{{ $tableName }}-bulkActionsDropdown" 
            
                        
            @if($component->isTailwind())
                        x-on:click="open = !open"
                        @else
                        data-toggle="dropdown" data-bs-toggle="dropdown"
                        @endif
            aria-haspopup="true" aria-expanded="false">

            @lang('Bulk Actions')
            @if($component->isTailwind())
                <x-heroicon-m-chevron-down class="-mr-1 ml-2 h-5 w-5" />
            @endif
        </button>
        
        @if($component->isTailwind())
            <div
                x-on:click.away="if (!childElementOpen) { open = false }"
                @keydown.window.escape="if (!childElementOpen) { open = false }"
                x-cloak x-show="open"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="origin-top-right absolute right-0 mt-2 w-full md:w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none z-50"
            >
                <div
                    {{ 
                        $attributes->merge($this->getBulkActionsMenuAttributes)
                        ->class([
                            'bg-white dark:bg-gray-700 dark:text-white' => $component->isTailwind() && $this->getBulkActionsMenuAttributes['default-colors'] ?? true,
                            'rounded-md shadow-xs' => $component->isTailwind() && $this->getBulkActionsMenuAttributes['default-styling'] ?? true,
                        ])
                        ->except('default') 
                    }}
                >
                    <div class="py-1" role="menu" aria-orientation="vertical">
                        @foreach ($component->getBulkActions() as $action => $title)
                            <button
                                wire:click="{{ $action }}"
                                @if($component->hasConfirmationMessage($action))
                                    wire:confirm="{{ $component->getBulkActionConfirmMessage($action) }}"
                                @endif
                                wire:key="{{ $tableName }}-bulk-action-{{ $action }}"
                                type="button"
                                role="menuitem"
                                {{ 
                                    $attributes->merge($this->getBulkActionsMenuItemAttributes)
                                    ->class([
                                        'text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:bg-gray-100 focus:text-gray-900 dark:text-white dark:hover:bg-gray-600' => $component->isTailwind() && $this->getBulkActionsMenuItemAttributes['default-colors'] ?? true,
                                        'block w-full px-4 py-2 text-sm leading-5 focus:outline-none flex items-center space-x-2' => $component->isTailwind() && $this->getBulkActionsMenuItemAttributes['default-styling'] ?? true,
                                    ])
                                    ->except('default') 
                                }}
                            >
                                <span>{{ $title }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div
                {{ 
                    $attributes->merge($this->getBulkActionsMenuAttributes)
                    ->class([
                        'dropdown-menu dropdown-menu-right w-100' => $component->isBootstrap4() && $this->getBulkActionsMenuAttributes['default-styling'] ?? true,
                        'dropdown-menu dropdown-menu-end w-100' => $component->isBootstrap5() && $this->getBulkActionsMenuAttributes['default-styling'] ?? true,
                    ])
                    ->except('default') 
                }}
                aria-labelledby="{{ $tableName }}-bulkActionsDropdown"
            >
                @foreach ($component->getBulkActions() as $action => $title)
                    <a
                        href="#"
                        @if($component->hasConfirmationMessage($action))
                            wire:confirm="{{ $component->getBulkActionConfirmMessage($action) }}"
                        @endif
                        wire:click="{{ $action }}"
                        wire:key="{{ $tableName }}-bulk-action-{{ $action }}"
                        {{ 
                            $attributes->merge($this->getBulkActionsMenuItemAttributes)
                                ->class([
                                    'dropdown-item' => $component->isBootstrap() && $this->getBulkActionsMenuItemAttributes['default-styling'] ?? true,
                                ])
                                ->except('default') 
                        }}
                    >
                        {{ $title }}
                    </a>
                @endforeach
            </div>
        @endif

    </div>
</div>
