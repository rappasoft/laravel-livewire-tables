@props(['column', 'index'])

@php
    $allThAttributes = $this->getAllThAttributes($column);
    $customThAttributes = $allThAttributes['customAttributes'];
    $customSortButtonAttributes = $allThAttributes['sortButtonAttributes'];
    $customLabelAttributes = $allThAttributes['labelAttributes'];
    $customIconAttributes = $this->getThSortIconAttributes($column);
    $direction = $column->hasField() ? $this->getSort($column->getColumnSelectName()) : $this->getSort($column->getSlug()) ?? null;
@endphp

<th {{
    $attributes->merge($customThAttributes)
        ->class([
            'text-gray-500 dark:bg-gray-800 dark:text-gray-400' => $this->isTailwind && (($customThAttributes['default-colors'] ?? true) || ($customThAttributes['default'] ?? true)),
            'px-6 py-3 text-left text-xs font-medium whitespace-nowrap uppercase tracking-wider' => $this->isTailwind && (($customThAttributes['default-styling'] ?? true) || ($customThAttributes['default'] ?? true)),
            'hidden' => $this->isTailwind && $column->shouldCollapseAlways(),
            'hidden md:table-cell' => $this->isTailwind && $column->shouldCollapseOnMobile(),
            'hidden lg:table-cell' => $this->isTailwind && $column->shouldCollapseOnTablet(),
            '' => $this->isBootstrap && ($customThAttributes['default'] ?? true),
            'd-none' => $this->isBootstrap && $column->shouldCollapseAlways(),
            'd-none d-md-table-cell' => $this->isBootstrap && $column->shouldCollapseOnMobile(),
            'd-none d-lg-table-cell' => $this->isBootstrap && $column->shouldCollapseOnTablet(),
        ])
        ->except(['default', 'default-colors', 'default-styling'])
}}>
    @if($column->getColumnLabelStatus())
        @unless ($this->sortingIsEnabled() && ($column->isSortable() || $column->getSortCallback()))
            <x-livewire-tables::table.th.label :$customLabelAttributes :columnTitle="$column->getTitle()" />
        @else
            @if ($this->isTailwind)

                <button wire:click="sortBy('{{ $column->getColumnSortKey() }}')" {{
                        $attributes->merge($customSortButtonAttributes)
                            ->class([
                                'text-gray-500 dark:text-gray-400' => (($customSortButtonAttributes['default-colors'] ?? true) || ($customSortButtonAttributes['default'] ?? true)),
                                'flex items-center space-x-1 text-left text-xs leading-4 font-medium uppercase tracking-wider group focus:outline-none' => (($customSortButtonAttributes['default-styling'] ?? true) || ($customSortButtonAttributes['default'] ?? true)),
                            ])
                            ->except(['default', 'default-colors', 'default-styling', 'wire:key'])
                }}>
                    <x-livewire-tables::table.th.label :$customLabelAttributes :columnTitle="$column->getTitle()" />
                    <x-livewire-tables::table.th.sort-icons :$direction :$customIconAttributes />
                </button>
            @elseif ($this->isBootstrap)
                <div wire:click="sortBy('{{ $column->getColumnSortKey() }}')" {{
                        $attributes->merge($customSortButtonAttributes)
                            ->class([
                                'd-flex align-items-center laravel-livewire-tables-cursor' => (($customSortButtonAttributes['default-styling'] ?? true) || ($customSortButtonAttributes['default'] ?? true))
                            ])
                            ->except(['default', 'default-colors', 'default-styling', 'wire:key'])
                }}>
                    <x-livewire-tables::table.th.label :$customLabelAttributes :columnTitle="$column->getTitle()" />
                    <x-livewire-tables::table.th.sort-icons :$direction :$customIconAttributes />

                </div>
            @endif

        @endunless
    @endif
</th>
