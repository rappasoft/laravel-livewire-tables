@aware([ 'tableName','isTailwind','isBootstrap','isBootstrap4','isBootstrap5', 'localisationPath'])
@props([])

@php
    // Own bag: $attributes is already spent on the button, and re-merging it here
    // would duplicate any pass-through attribute onto the badge
    $badgeAttributes = new \Illuminate\View\ComponentAttributeBag($this->getFilterButtonBadgeAttributes);
@endphp

<div 
                @class([
                    'ml-0 ml-md-2 mb-3 mb-md-0' => $isBootstrap4,
                    'ms-0 ms-md-2 mb-3 mb-md-0' => $isBootstrap5 && $this->searchIsEnabled(),
                    'mb-3 mb-md-0' => $isBootstrap5 && !$this->searchIsEnabled(),
                ])
>
    <div
        @if ($this->isFilterLayoutPopover())
            x-data="{ filterPopoverOpen: false }"
            x-on:keydown.escape.stop="if (!this.childElementOpen) { filterPopoverOpen = false }"
            x-on:mousedown.away="if (!this.childElementOpen) { filterPopoverOpen = false }"
        @endif
        @class([
            'btn-group d-block d-md-inline' => $isBootstrap,
            'relative block md:inline-block text-left' => $isTailwind,
        ])
    >
        <div>
            <button
                type="button"
                {{
                    $attributes
                    ->merge($this->getFilterButtonAttributes)
                    ->class([
                        'btn dropdown-toggle d-block w-100 d-md-inline' => $isBootstrap && ($this->getFilterButtonAttributes['default-styling'] ?? true),
                        'inline-flex justify-center w-full rounded-md border shadow-sm px-4 py-2 text-sm font-medium focus:ring focus:ring-opacity-50' => $isTailwind && ($this->getFilterButtonAttributes['default-styling'] ?? true),
                        'border-gray-300 bg-white text-gray-700 hover:bg-gray-50 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600' => $isTailwind && ($this->getFilterButtonAttributes['default-colors'] ?? true),
                    ])
                    ->except(['default','default-styling','default-colors'])
                }}
                @if ($this->isFilterLayoutPopover()) x-on:click="filterPopoverOpen = !filterPopoverOpen"
                    aria-haspopup="true"
                    x-bind:aria-expanded="filterPopoverOpen"
                    aria-expanded="true"
                @endif
                @if ($this->isFilterLayoutSlideDown()) x-on:click="filtersOpen = !filtersOpen" @endif
            >
                {{ __($localisationPath.'Filters') }}

                @if ($count = $this->getFilterBadgeCount())
                    <span {{
                            $badgeAttributes
                            ->class([
                                'badge badge-info' => $isBootstrap && ($this->getFilterButtonBadgeAttributes['default-styling'] ?? true),
                                'ml-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 capitalize' => $isTailwind && ($this->getFilterButtonBadgeAttributes['default-styling'] ?? true),
                                'bg-indigo-100 text-indigo-800 dark:bg-indigo-200 dark:text-indigo-900' => $isTailwind && ($this->getFilterButtonBadgeAttributes['default-colors'] ?? true),
                            ])
                            ->except(['default','default-styling','default-colors'])
                        }}>
                        {{ $count }}
                    </span>
                @endif

                @if($isTailwind)
                    <x-heroicon-o-funnel class="-mr-1 ml-2 h-5 w-5" />
                @else
                <span @class([
                    'caret' => $isBootstrap,
                ])></span>
                @endif

            </button>
        </div>

        @if ($this->isFilterLayoutPopover())
            <x-livewire-tables::tools.toolbar.items.filter-popover  />
        @endif

    </div>
</div>
