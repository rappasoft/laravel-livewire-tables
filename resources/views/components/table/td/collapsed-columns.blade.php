@props(['rowIndex', 'hidden' => false])

@if ($this->collapsingColumnsAreEnabled && $this->hasCollapsedColumns)
    @if ($this->isTailwind)
        <td x-data="{open:false}" wire:key="{{ $this->getTableName }}-collapsingIcon-{{ $rowIndex }}-{{ $this->getNow }}"
            {{
                $attributes
                    ->merge(['class' => 'p-3 table-cell text-center '])
                    ->class(['sm:hidden' => !$this->shouldCollapseAlways && !$this->shouldCollapseOnTablet])
                    ->class(['md:hidden' => !$this->shouldCollapseAlways && !$this->shouldCollapseOnTablet && $this->shouldCollapseOnMobile])
                    ->class(['lg:hidden' => !$this->shouldCollapseAlways && ($this->shouldCollapseOnTablet || $this->shouldCollapseOnMobile)])
            }}
            :class="currentlyReorderingStatus ? 'laravel-livewire-tables-reorderingMinimised' : ''"
        >
            @if (! $hidden)
                <button
                    x-cloak x-show="!currentlyReorderingStatus"
                    x-on:click.prevent="$dispatch('toggle-row-content', {'tableName': '{{ $this->getTableName }}', 'row': {{ $rowIndex }}}); open = !open"
                >
                    <x-heroicon-o-plus-circle x-cloak x-show="!open" 
                        {{ 
                            $attributes->merge($this->getCollapsingColumnButtonExpandAttributes)
                            ->class([
                                'h-6 w-6' => $this->getCollapsingColumnButtonExpandAttributes['default-styling'] ?? true,
                                'text-green-600' => $this->getCollapsingColumnButtonExpandAttributes['default-colors'] ?? true,
                            ])
                            ->except('default') 
                        }}
                     />
                    <x-heroicon-o-minus-circle x-cloak x-show="open" 
                        {{ 
                            $attributes->merge($this->getCollapsingColumnButtonCollapseAttributes)
                            ->class([
                                'h-6 w-6' => $this->getCollapsingColumnButtonCollapseAttributes['default-styling'] ?? true,
                                'text-yellow-600' => $this->getCollapsingColumnButtonCollapseAttributes['default-colors'] ?? true,
                            ])
                            ->except('default') 
                        }}
                    />
                </button>
            @endif
        </td>
    @elseif ($this->isBootstrap)
        <td x-data="{open:false}" wire:key="{{ $this->getTableName }}-collapsingIcon-{{ $rowIndex }}-{{ $this->getNow }}" 
            {{
                $attributes
                    ->class(['d-sm-none' => !$this->shouldCollapseAlways && !$this->shouldCollapseOnTablet])
                    ->class(['d-md-none' => !$this->shouldCollapseAlways && !$this->shouldCollapseOnTablet && $this->shouldCollapseOnMobile])
                    ->class(['d-lg-none' => !$this->shouldCollapseAlways && ($this->shouldCollapseOnTablet || $this->shouldCollapseOnMobile)])
            }}
            :class="currentlyReorderingStatus ? 'laravel-livewire-tables-reorderingMinimised' : ''"
        >
            @if (! $hidden)
                <button
                    x-cloak x-show="!currentlyReorderingStatus"
                    x-on:click.prevent="$dispatch('toggle-row-content', {'tableName': '{{ $this->getTableName }}', 'row': {{ $rowIndex }}});open = !open"
                    class="border-0 bg-transparent p-0"
                >
                    <x-heroicon-o-plus-circle x-cloak x-show="!open"  
                        {{ 
                            $attributes->merge($this->getCollapsingColumnButtonExpandAttributes)
                            ->class([
                                'laravel-livewire-tables-btn-lg text-success' => $this->getCollapsingColumnButtonExpandAttributes['default-colors'] ?? true,
                            ])
                            ->except('default') 
                        }}
                    />
                    <x-heroicon-o-minus-circle x-cloak x-show="open" 
                        {{ 
                            $attributes->merge($this->getCollapsingColumnButtonExpandAttributes)
                            ->class([
                                'laravel-livewire-tables-btn-lg text-warning' => $this->getCollapsingColumnButtonExpandAttributes['default-colors'] ?? true,
                            ])
                            ->except('default') 
                        }}
                    />
                </button>
            @endif
        </td>
    @endif
@endif
