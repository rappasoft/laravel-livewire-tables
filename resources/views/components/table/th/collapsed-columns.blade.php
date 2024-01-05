@aware(['component', 'tableName'])

@if ($component->collapsingColumnsAreEnabled() && $component->hasCollapsedColumns())
        <th
            scope="col"
            {{
                $attributes
                    ->merge(['class' => ''])
                    ->class(['table-cell dark:bg-gray-800 laravel-livewire-tables-reorderingMinimised' => $component->isTailwind()])
                    ->class(['sm:hidden' => $component->isTailwind() && !$component->shouldCollapseOnTablet() && !$component->shouldCollapseAlways()])
                    ->class(['md:hidden' => $component->isTailwind() && !$component->shouldCollapseOnMobile() && !$component->shouldCollapseOnTablet() && !$component->shouldCollapseAlways()])
                    ->class(['lg:hidden' => $component->isTailwind() && !$component->shouldCollapseAlways()])
                    ->class(['d-table-cell laravel-livewire-tables-reorderingMinimised' => $component->isBootstrap()])
                    ->class(['d-sm-none' => $component->isBootstrap() && !$component->shouldCollapseOnTablet() && !$component->shouldCollapseAlways()])
                    ->class(['d-md-none' => $component->isBootstrap() && !$component->shouldCollapseOnMobile() && !$component->shouldCollapseOnTablet() && !$component->shouldCollapseAlways()])
                    ->class(['d-lg-none' => $component->isBootstrap() && !$component->shouldCollapseAlways()])
            }}                    
            :class="{ 'laravel-livewire-tables-reorderingMinimised': ! currentlyReorderingStatus }"
        ></th>
@endif
