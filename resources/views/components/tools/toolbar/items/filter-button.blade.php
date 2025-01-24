@aware([ 'tableName','isTailwind','isBootstrap','isBootstrap4','isBootstrap5'])
@props([])

<div
                @class([
                    'ml-0 ml-md-2 mb-3 mb-md-0' => $this->isBootstrap4,
                    'ms-0 ms-md-2 mb-3 mb-md-0' => $this->isBootstrap5 && $this->searchIsEnabled(),
                    'mb-3 mb-md-0' => $this->isBootstrap5 && !$this->searchIsEnabled(),
                ])
>
    <div
        @if ($this->isFilterLayoutPopover())
            x-data="{ filterPopoverOpen: false }"
            x-on:keydown.escape.stop="if (!this.childElementOpen) { filterPopoverOpen = false }"
            x-on:mousedown.away="if (!this.childElementOpen) { filterPopoverOpen = false }"
        @endif
        @class([
            'btn-group d-block d-md-inline' => $this->isBootstrap,
            'relative block md:inline-block text-left' => $this->isTailwind,
        ])
    >
        <div>
            <button
                type="button"
                {{
                    $attributes->merge($this->getFilterButtonAttributes())
                    ->class([
                        'btn dropdown-toggle d-block w-100 d-md-inline' => $this->isBootstrap && $this->getFilterButtonAttributes()['default-styling'],
                        'inline-flex justify-center w-full rounded-md border shadow-sm px-4 py-2 text-sm font-medium focus:ring focus:ring-opacity-50' => $this->isTailwind && $this->getFilterButtonAttributes()['default-styling'],
                        'border-gray-300 bg-white text-gray-700 hover:bg-gray-50 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600' => $this->isTailwind && $this->getFilterButtonAttributes()['default-colors'],
                    ])
                    ->except(['default-styling', 'default-colors'])
                }}
                @if ($this->isFilterLayoutPopover()) x-on:click="filterPopoverOpen = !filterPopoverOpen"
                    aria-haspopup="true"
                    x-bind:aria-expanded="filterPopoverOpen"
                    aria-expanded="true"
                @endif
                @if ($this->isFilterLayoutSlideDown()) x-on:click="filtersOpen = !filtersOpen" @endif
            >
                {{ __($this->getLocalisationPath.'Filters') }}

                @if ($count = $this->getFilterBadgeCount())
                    <span
                        {{
                            $attributes->merge($this->getFilterButtonBadgeAttributes())
                            ->class([
                                'badge badge-info' => $this->isBootstrap && $this->getFilterButtonBadgeAttributes()['default-styling'],
                                'ml-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 capitalize' => $this->isTailwind && $this->getFilterButtonBadgeAttributes()['default-styling'],
                                'bg-indigo-100 text-indigo-800 dark:bg-indigo-200 dark:text-indigo-900' => $this->isTailwind && $this->getFilterButtonBadgeAttributes()['default-colors'],
                            ])
                            ->except(['default-styling', 'default-colors'])
                        }}
                    >
                        {{ $count }}
                    </span>
                @endif

                @if($this->isTailwind)
                    <x-heroicon-o-funnel class="-mr-1 ml-2 h-5 w-5" />
                @else
                <span @class([
                    'caret' => $this->isBootstrap,
                ])></span>
                @endif

            </button>
        </div>

        @if ($this->isFilterLayoutPopover())
            <x-livewire-tables::tools.toolbar.items.filter-popover  />
        @endif

    </div>
</div>
