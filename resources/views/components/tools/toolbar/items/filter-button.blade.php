@aware([ 'tableName','isTailwind','isBootstrap','isBootstrap4','isBootstrap5', 'localisationPath'])
@props([])

@if($isBootstrap)
    <div class="mb-3 mb-md-0">
        <div
            @if ($this->isFilterLayoutPopover())
                x-data="{ filterPopoverOpen: false }"
                x-on:keydown.escape.stop="if (!this.childElementOpen) { filterPopoverOpen = false }"
                x-on:mousedown.away="if (!this.childElementOpen) { filterPopoverOpen = false }"
            @endif
            class="btn-group d-block d-md-inline"
        >
            <button
                type="button"
                class="lwt-btn"
                @if ($this->isFilterLayoutPopover())
                    x-on:click="filterPopoverOpen = !filterPopoverOpen"
                    aria-haspopup="true"
                    x-bind:aria-expanded="filterPopoverOpen"
                @endif
                @if ($this->isFilterLayoutSlideDown()) x-on:click="filtersOpen = !filtersOpen" @endif
            >
                <i class="bi bi-funnel lwt-btn__icon" aria-hidden="true"></i>
                <span>{{ __($localisationPath.'Filters') }}</span>

                @if ($count = $this->getFilterBadgeCount())
                    <span class="lwt-btn__badge" aria-label="{{ $count }} {{ __($localisationPath.'Filters') }}">{{ $count }}</span>
                @endif

                @if ($this->isFilterLayoutPopover())
                    <i class="bi bi-chevron-down lwt-btn__caret" aria-hidden="true"></i>
                @endif
            </button>

            @if ($this->isFilterLayoutPopover())
                <x-livewire-tables::tools.toolbar.items.filter-popover />
            @endif
        </div>
    </div>
@else
    <div class="relative block md:inline-block text-left">
        <div
            @if ($this->isFilterLayoutPopover())
                x-data="{ filterPopoverOpen: false }"
                x-on:keydown.escape.stop="if (!this.childElementOpen) { filterPopoverOpen = false }"
                x-on:mousedown.away="if (!this.childElementOpen) { filterPopoverOpen = false }"
            @endif
            class="relative block md:inline-block text-left"
        >
            <div>
                <button
                    type="button"
                    class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600"
                    @if ($this->isFilterLayoutPopover())
                        x-on:click="filterPopoverOpen = !filterPopoverOpen"
                        aria-haspopup="true"
                        x-bind:aria-expanded="filterPopoverOpen"
                    @endif
                    @if ($this->isFilterLayoutSlideDown()) x-on:click="filtersOpen = !filtersOpen" @endif
                >
                    {{ __($localisationPath.'Filters') }}

                    @if ($count = $this->getFilterBadgeCount())
                        <span class="ml-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-indigo-100 text-indigo-800 capitalize dark:bg-indigo-200 dark:text-indigo-900">
                            {{ $count }}
                        </span>
                    @endif

                    <x-heroicon-o-funnel class="-mr-1 ml-2 h-5 w-5" />
                </button>
            </div>

            @if ($this->isFilterLayoutPopover())
                <x-livewire-tables::tools.toolbar.items.filter-popover />
            @endif
        </div>
    </div>
@endif
