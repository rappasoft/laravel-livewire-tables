@aware(['component', 'tableName'])
@props(['rowIndex', 'hidden' => false])

@if ($component->collapsingColumnsAreEnabled() && $component->hasCollapsedColumns())
    @if ($component->isTailwind())
        <td x-data="{open:false}" wire:key="{{ $tableName }}-collapsingIcon-{{ $rowIndex }}-{{ md5(now()) }}"
            {{
                $attributes
                    ->merge(['class' => 'p-3 table-cell text-center '])
                    ->class(['sm:hidden' => !$component->shouldCollapseAlways() && !$component->shouldCollapseOnTablet()])
                    ->class(['md:hidden' => !$component->shouldCollapseAlways() && !$component->shouldCollapseOnTablet() && $component->shouldCollapseOnMobile()])
                    ->class(['lg:hidden' => !$component->shouldCollapseAlways() && ($component->shouldCollapseOnTablet() || $component->shouldCollapseOnMobile())])
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
    @elseif ($component->isBootstrap())
        <td x-data="{open:false}" wire:key="{{ $tableName }}-collapsingIcon-{{ $rowIndex }}-{{ md5(now()) }}" 
            {{
                $attributes
                    ->class(['d-sm-none' => !$component->shouldCollapseAlways() && !$component->shouldCollapseOnTablet()])
                    ->class(['d-md-none' => !$component->shouldCollapseAlways() && !$component->shouldCollapseOnTablet() && $component->shouldCollapseOnMobile()])
                    ->class(['d-lg-none' => !$component->shouldCollapseAlways() && ($component->shouldCollapseOnTablet() || $component->shouldCollapseOnMobile())])
            }}
            :class="currentlyReorderingStatus ? 'laravel-livewire-tables-reorderingMinimised' : ''"
        >
            @if (! $hidden)
                <button
                    x-cloak x-show="!currentlyReorderingStatus"
                    x-on:click.prevent="$dispatch('toggle-row-content', {'tableName': '{{ $tableName }}', 'row': {{ $rowIndex }}});open = !open"
                    class="p-0"
                    style="background:none;border:none;"
                >
                    <x-heroicon-o-plus-circle x-cloak x-show="!open" style="width:1.4em;height:1.4em;" 
                        {{ 
                            $attributes->merge($this->getCollapsingColumnButtonExpandAttributes)
                            ->class([
                                'text-success' => $this->getCollapsingColumnButtonExpandAttributes['default-colors'] ?? true,
                            ])
                            ->except('default') 
                        }}
                    />
                    <x-heroicon-o-minus-circle x-cloak x-show="open" style="width:1.4em;height:1.4em;" 
                        {{ 
                            $attributes->merge($this->getCollapsingColumnButtonExpandAttributes)
                            ->class([
                                'text-warning' => $this->getCollapsingColumnButtonExpandAttributes['default-colors'] ?? true,
                            ])
                            ->except('default') 
                        }}
                    />
                </button>
            @endif
        </td>
    @endif
@endif
