@aware([ 'tableName','isTailwind','isBootstrap'])
@props(['rowIndex', 'hidden' => false])

@if ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns())
    @if ($isTailwind)
        <td x-data="{open:false}" wire:key="{{ $tableName }}-collapsingIcon-{{ $rowIndex }}-{{ md5(now()) }}"
            {{
                $attributes->merge()
                    ->class(['p-3 table-cell text-center' => $this->isTailwind])
                    ->class(['sm:hidden' => $this->isTailwind && !$this->shouldCollapseAlways() && !$this->shouldCollapseOnTablet()])
                    ->class(['md:hidden' => $this->isTailwind && !$this->shouldCollapseAlways() && !$this->shouldCollapseOnTablet() && $this->shouldCollapseOnMobile()])
                    ->class(['lg:hidden' => $this->isTailwind && !$this->shouldCollapseAlways() && ($this->shouldCollapseOnTablet() || $this->shouldCollapseOnMobile())])
                    ->class(['d-sm-none' => $this->isBootstrap && !$this->shouldCollapseAlways() && !$this->shouldCollapseOnTablet()])
                    ->class(['d-md-none' => $this->isBootstrap && !$this->shouldCollapseAlways() && !$this->shouldCollapseOnTablet() && $this->shouldCollapseOnMobile()])
                    ->class(['d-lg-none' => $this->isBootstrap && !$this->shouldCollapseAlways() && ($this->shouldCollapseOnTablet() || $this->shouldCollapseOnMobile())])

            }}
            :class="currentlyReorderingStatus ? 'laravel-livewire-tables-reorderingMinimised' : ''"
        >
            @if (! $hidden)
                <button
                    x-cloak x-show="!currentlyReorderingStatus"
                    x-on:click.prevent="$dispatch('toggle-row-content', {'tableName': '{{ $tableName }}', 'row': {{ $rowIndex }}}); open = !open"
                >
                    <x-heroicon-o-plus-circle x-cloak x-show="!open" 
                        {{ 
                            $attributes->merge($this->getCollapsingColumnButtonExpandAttributes)
                            ->class([
                                'h-6 w-6' => $this->getCollapsingColumnButtonExpandAttributes['default-styling'] ?? true,
                                'text-green-600' => $this->getCollapsingColumnButtonExpandAttributes['default-colors'] ?? true,
                            ])
                            ->except(['default','default-styling','default-colors']) 
                        }}
                     />
                    <x-heroicon-o-minus-circle x-cloak x-show="open" 
                        {{ 
                            $attributes->merge($this->getCollapsingColumnButtonCollapseAttributes)
                            ->class([
                                'h-6 w-6' => $this->getCollapsingColumnButtonCollapseAttributes['default-styling'] ?? true,
                                'text-yellow-600' => $this->getCollapsingColumnButtonCollapseAttributes['default-colors'] ?? true,
                            ])
                            ->except(['default','default-styling','default-colors']) 
                        }}
                    />
                </button>
            @endif
        </td>
    @elseif ($isBootstrap)
        <td x-data="{open:false}" wire:key="{{ $tableName }}-collapsingIcon-{{ $rowIndex }}-{{ md5(now()) }}" 

            :class="currentlyReorderingStatus ? 'laravel-livewire-tables-reorderingMinimised' : ''"
        >
            @if (! $hidden)
                <button
                    x-cloak x-show="!currentlyReorderingStatus"
                    x-on:click.prevent="$dispatch('toggle-row-content', {'tableName': '{{ $tableName }}', 'row': {{ $rowIndex }}});open = !open"
                    class="border-0 bg-transparent p-0"
                >
                    <x-heroicon-o-plus-circle x-cloak x-show="!open"  
                        {{ 
                            $attributes->merge($this->getCollapsingColumnButtonExpandAttributes)
                            ->class([
                                'laravel-livewire-tables-btn-lg text-success' => $this->getCollapsingColumnButtonExpandAttributes['default-colors'] ?? true,
                            ])
                            ->except(['default','default-styling','default-colors']) 
                        }}
                    />
                    <x-heroicon-o-minus-circle x-cloak x-show="open" 
                        {{ 
                            $attributes->merge($this->getCollapsingColumnButtonExpandAttributes)
                            ->class([
                                'laravel-livewire-tables-btn-lg text-warning' => $this->getCollapsingColumnButtonExpandAttributes['default-colors'] ?? true,
                            ])
                            ->except(['default','default-styling','default-colors']) 
                        }}
                    />
                </button>
            @endif
        </td>
    @endif
@endif
