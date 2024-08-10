@aware(['component', 'tableName','isTailwind','isBootstrap'])
@props(['column', 'index'])

@php
    $attributes = $attributes->merge(['wire:key' => $tableName . '-header-col-'.$column->getSlug()]);
    $customAttributes = $component->getThAttributes($column);
    $customSortButtonAttributes = $component->getThSortButtonAttributes($column);
    $direction = $column->hasField() ? $component->getSort($column->getColumnSelectName()) : $component->getSort($column->getSlug()) ?? null ;
@endphp

@if ($isTailwind)
    <th scope="col" {{
        $attributes->merge($customAttributes)
            ->class(['px-6 py-3 text-left text-xs font-medium whitespace-nowrap text-gray-500 uppercase tracking-wider dark:bg-gray-800 dark:text-gray-400' => $customAttributes['default'] ?? true])
            ->class(['hidden' => $column->shouldCollapseAlways()])
            ->class(['hidden md:table-cell' => $column->shouldCollapseOnMobile()])
            ->class(['hidden lg:table-cell' => $column->shouldCollapseOnTablet()])
            ->except('default')
        }}
    >
        @if($column->getColumnLabelStatus())
            @unless ($component->sortingIsEnabled() && ($column->isSortable() || $column->getSortCallback()))
                {{ $column->getTitle() }}
            @else
                <button
                    wire:click="sortBy('{{ ($column->isSortable() ? $column->getColumnSelectName() : $column->getSlug()) }}')"
                    {{
                        $attributes->merge($customSortButtonAttributes)
                            ->class(['flex items-center space-x-1 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider group focus:outline-none dark:text-gray-400' => $customSortButtonAttributes['default'] ?? true])
                            ->except(['default', 'wire:key'])
                    }}
                >
                    <span {{
        $attributes->merge($customAttributes)
            ->class(['text-left text-xs font-medium whitespace-nowrap text-gray-500 uppercase tracking-wider dark:bg-gray-800 dark:text-gray-400' => $customAttributes['default'] ?? true])
            ->class(['hidden' => $column->shouldCollapseAlways()])
            ->class(['hidden md:table-cell' => $column->shouldCollapseOnMobile()])
            ->class(['hidden lg:table-cell' => $column->shouldCollapseOnTablet()])
            ->except('default')
        }}>{{ $column->getTitle() }}</span>

                    <span class="relative flex items-center">
                        @if ($direction === 'asc')
                            <x-heroicon-o-chevron-up class="w-3 h-3 group-hover:opacity-0" />
                            <x-heroicon-o-chevron-down class="w-3 h-3 opacity-0 group-hover:opacity-100 absolute"/>
                        @elseif ($direction === 'desc')
                            <x-heroicon-o-chevron-down class="w-3 h-3 group-hover:opacity-0" />
                            <x-heroicon-o-x-circle class="w-3 h-3 opacity-0 group-hover:opacity-100 absolute"/>
                        @else
                            <x-heroicon-o-chevron-up class="w-3 h-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300" />
                        @endif
                    </span>
                </button>
            @endunless
        @endif
    </th>
@elseif ($isBootstrap)
    <th scope="col" {{
        $attributes->merge($customAttributes)
            ->class(['' => $customAttributes['default'] ?? true])
            ->class(['d-none' => $column->shouldCollapseAlways()])
            ->class(['d-none d-md-table-cell' => $column->shouldCollapseOnMobile()])
            ->class(['d-none d-lg-table-cell' => $column->shouldCollapseOnTablet()])
            ->except('default')
        }}
    >
        @if($column->getColumnLabelStatus())
            @unless ($component->sortingIsEnabled() && ($column->isSortable() || $column->getSortCallback()))
                {{ $column->getTitle() }}
            @else
                <div
                    class="d-flex align-items-center laravel-livewire-tables-cursor"
                    wire:click="sortBy('{{ ($column->isSortable() ? $column->getColumnSelectName() : $column->getSlug()) }}')"
                >
                    <span>{{ $column->getTitle() }}</span>

                    <span class="relative d-flex align-items-center">
                        @if ($direction === 'asc')
                            <x-heroicon-o-chevron-up class="laravel-livewire-tables-btn-smaller ms-1 "  />
                        @elseif ($direction === 'desc')
                            <x-heroicon-o-chevron-down class="laravel-livewire-tables-btn-smaller ms-1"  />
                        @else
                            <x-heroicon-o-chevron-up-down class="laravel-livewire-tables-btn-smaller ms-1" />
                        @endif
                    </span>
                </div>
            @endunless
        @endif
    </th>
@endif
