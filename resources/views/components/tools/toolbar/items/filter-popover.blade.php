@aware(['tableName'])
@if($this->isBootstrap)
    <ul x-cloak {{ $attributes
            ->merge($this->getFilterPopoverAttributes)
            ->merge(['role' => 'menu'])
            ->class([
                'dropdown-menu dropdown-menu-end mt-md-5' => $this->isBootstrap4,
                'dropdown-menu dropdown-menu-end' => $this->isBootstrap5,
            ])
            ->except(['default', 'default-width', 'default-styling', 'default-colors']) }} x-bind:class="{ 'show': filterPopoverOpen }">
        <div class="lwt-filter-grid">
            @foreach ($this->getVisibleFilters() as $filter)
                <div id="{{ $tableName }}-filter-{{ $filter->getKey() }}-wrapper" wire:key="{{ $tableName }}-filter-{{ $filter->getKey() }}-toolbar" @class([
                    'lwt-filter-col',
                    'lwt-filter-col--wide' => $filter instanceof \Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter || $filter instanceof \Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectDropdownFilter,
                ])>
                    {{ $filter->setGenericDisplayData($this->getFilterGenericData)->render() }}
                </div>
            @endforeach
        </div>

        @if ($this->hasAppliedVisibleFiltersWithValuesThatCanBeCleared())
            <div class='dropdown-divider'></div>
            <x-livewire-tables::tools.toolbar.items.filter-popover.clear-button />
        @endif
    </ul>
@else
    <div x-cloak x-show="filterPopoverOpen"
        {{ 
            $attributes
            ->merge($this->getFilterPopoverAttributes)
            ->merge([
                'role' => 'menu',
                'aria-orientation' => 'vertical',
                'aria-labelledby' => 'filters-menu',
                'x-transition:enter' => 'transition ease-out duration-100',
                'x-transition:enter-start' => 'transform opacity-0 scale-95',
                'x-transition:enter-end' => 'transform opacity-100 scale-100',
                'x-transition:leave' => 'transition ease-in duration-75',
                'x-transition:leave-start' => 'transform opacity-100 scale-100',
                'x-transition:leave-end' => 'transform opacity-0 scale-95',
            ])
            ->class([
                'w-full md:w-56' => $this->getFilterPopoverAttributes['default-width'] ?? true,
                'origin-top-left absolute left-0 mt-2 rounded-md shadow-lg ring-1 ring-opacity-5 divide-y focus:outline-none z-50' => $this->getFilterPopoverAttributes['default-styling'] ?? true,
                'bg-white divide-gray-100 ring-black dark:bg-gray-700 dark:text-white dark:divide-gray-600' => $this->getFilterPopoverAttributes['default-colors'] ?? true,
            ])
            ->except(['x-cloak', 'x-show', 'default','default-width', 'default-styling','default-colors']) 
        }}>

        @foreach ($this->getVisibleFilters() as $filter)
            <div class="py-1" role="none">
                <div id="{{ $tableName }}-filter-{{ $filter->getKey() }}-wrapper" wire:key="{{ $tableName }}-filter-{{ $filter->getKey() }}-toolbar" class="block px-4 py-2 text-sm text-gray-700 space-y-1" role="menuitem">
                    {{ $filter->setGenericDisplayData($this->getFilterGenericData)->render() }}
                </div>
            </div>
        @endforeach

        @if ($this->hasAppliedVisibleFiltersWithValuesThatCanBeCleared())
            <div class="block px-4 py-3 text-sm text-gray-700 dark:text-white" role="menuitem">
                <x-livewire-tables::tools.toolbar.items.filter-popover.clear-button />
            </div>
        @endif
    </div>
@endif