@aware([ 'tableName','isTailwind','isBootstrap'])
@props(['column', 'index'])

@php
    $attributes = $attributes->merge(['wire:key' => $tableName . '-header-col-'.$column->getSlug()]);
    $allThAttributes = $this->getAllThAttributes($column);

    $customThAttributes = $allThAttributes['customAttributes'];
    $customSortButtonAttributes = $allThAttributes['sortButtonAttributes'];
    $customSortIconAttributes = $allThAttributes['sortIconAttributes'];
    $customLabelAttributes = $allThAttributes['labelAttributes'];

    $direction = $column->hasField() ? $this->getSort($column->getColumnSelectName()) : $this->getSort($column->getSlug()) ?? null ;
@endphp

<th scope="col" {{ $attributes->merge($customThAttributes)
        ->class(['text-gray-500 dark:bg-gray-800 dark:text-gray-400' => $isTailwind && (($customThAttributes['default-colors'] ?? true) || ($customThAttributes['default'] ?? true))])
        ->class(['px-6 py-3 text-left text-xs font-medium whitespace-nowrap uppercase tracking-wider' => $isTailwind && (($customThAttributes['default-styling'] ?? true) || ($customThAttributes['default'] ?? true))])
        ->class(['hidden' => $isTailwind && $column->shouldCollapseAlways()])
        ->class(['hidden md:table-cell' => $isTailwind && $column->shouldCollapseOnMobile()])
        ->class(['hidden lg:table-cell' => $isTailwind && $column->shouldCollapseOnTablet()])
        ->class(['d-none' => $isBootstrap && $column->shouldCollapseAlways()])
        ->class(['d-none d-md-table-cell' => $isBootstrap && $column->shouldCollapseOnMobile()])
        ->class(['d-none d-lg-table-cell' => $isBootstrap && $column->shouldCollapseOnTablet()])
        ->except(['default', 'default-colors', 'default-styling'])
}}>
    @if($column->getColumnLabelStatus())
        @unless ($this->sortingIsEnabled() && ($column->isSortable() || $column->getSortCallback()))
            <span {{ $customLabelAttributes->except(['default', 'default-colors', 'default-styling']) }}>{{ $column->getTitle() }}</span>
        @else

            @if ($isTailwind)
                    <button wire:click="sortBy('{{ $column->getColumnSortKey() }}')" {{
                            $attributes->merge($customSortButtonAttributes)
                                ->class(['text-gray-500 dark:text-gray-400' => (($customSortButtonAttributes['default-colors'] ?? true) || ($customSortButtonAttributes['default'] ?? true))])
                                ->class(['flex items-center space-x-1 text-left text-xs leading-4 font-medium uppercase tracking-wider group focus:outline-none' => (($customSortButtonAttributes['default-styling'] ?? true) || ($customSortButtonAttributes['default'] ?? true))])
                                ->except(['default', 'default-colors', 'default-styling', 'wire:key'])
                    }}>
                        <span {{ $customLabelAttributes->except(['default', 'default-colors', 'default-styling']) }}>{{ $column->getTitle() }}</span>
                        <x-livewire-tables::table.th.sort-icons :$direction {{  $attributes->merge($customSortIconAttributes)
                                ->except(['default', 'default-colors', 'default-styling', 'wire:key'])
                        }} />
                    </button>
            @elseif ($isBootstrap)
                <div class="d-flex align-items-center laravel-livewire-tables-cursor" wire:click="sortBy('{{ $column->getColumnSortKey() }}')" {{ $attributes->merge($customSortButtonAttributes)
                            ->class(['' => (($customSortButtonAttributes['default-styling'] ?? true) || ($customSortButtonAttributes['default'] ?? true))])
                            ->except(['default', 'default-colors', 'default-styling', 'wire:key'])
                }}>
                    <span {{ $customLabelAttributes->except(['default', 'default-colors', 'default-styling']) }}>{{ $column->getTitle() }}</span>

                    <x-livewire-tables::table.th.sort-icons :$direction {{  $attributes->merge($customSortButtonAttributes)
                            ->class(['' => (($customSortButtonAttributes['default-colors'] ?? true) || ($customSortButtonAttributes['default'] ?? true))])
                            ->except(['default', 'default-colors', 'default-styling', 'wire:key'])
                         }} />
                </div>
            @endif
        @endunless
    @endif
</th>
