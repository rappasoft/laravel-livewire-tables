@aware(['component', 'tableName'])

@if ($component->collapsingColumnsAreEnabled() && $component->hasCollapsedColumns())
    @if ($component->isTailwind())
        <x-livewire-tables::table.th.plain
            wire:key="{{ $tableName }}-thead-collapsed"
            x-show="currentlyReorderingStatus"
        />

        <th x-show="!currentlyReorderingStatus"
            scope="col"
            {{
                $attributes
                    ->merge(['class' => 'table-cell dark:bg-gray-800'])
                    ->class([
                        'md:hidden' =>
                            (($component->shouldCollapseOnMobile() && $component->shouldCollapseOnTablet()) ||
                            ($component->shouldCollapseOnTablet() && ! $component->shouldCollapseOnMobile()))
                    ])
                    ->class(['sm:hidden' => $component->shouldCollapseOnMobile() && ! $component->shouldCollapseOnTablet()])
            }}
        ></th>
    @elseif ($component->isBootstrap())
        <th x-show="!currentlyReorderingStatus"
            scope="col"
            {{
                $attributes
                    ->merge(['class' => 'd-table-cell'])
                    ->class([
                        'd-md-none' =>
                            (($component->shouldCollapseOnMobile() && $component->shouldCollapseOnTablet()) ||
                            ($component->shouldCollapseOnTablet() && ! $component->shouldCollapseOnMobile()))
                    ])
                    ->class(['d-sm-none' => $component->shouldCollapseOnMobile() && ! $component->shouldCollapseOnTablet()])
            }}
        ></th>
    @endif
@endif
