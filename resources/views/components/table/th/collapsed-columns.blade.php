@aware(['component', 'tableName','isTailwind','isBootstrap'])

@if ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns())
    @if ($isTailwind)
        <th
            scope="col"
            {{
                $attributes
                    ->merge(['class' => 'table-cell dark:bg-gray-800 laravel-livewire-tables-reorderingMinimised'])
                    ->class(['sm:hidden' => !$this->shouldCollapseOnTablet() && !$this->shouldCollapseAlways()])
                    ->class(['md:hidden' => !$this->shouldCollapseOnMobile() && !$this->shouldCollapseOnTablet() && !$this->shouldCollapseAlways()])
                    ->class(['lg:hidden' => !$this->shouldCollapseAlways()])
            }}
            :class="{ 'laravel-livewire-tables-reorderingMinimised': ! currentlyReorderingStatus }"
        ></th>
    @elseif ($isBootstrap)
        <th
            scope="col"
            {{
                $attributes
                    ->merge(['class' => 'd-table-cell laravel-livewire-tables-reorderingMinimised'])
                    ->class(['d-sm-none' => !$this->shouldCollapseOnTablet() && !$this->shouldCollapseAlways()])
                    ->class(['d-md-none' => !$this->shouldCollapseOnMobile() && !$this->shouldCollapseOnTablet() && !$this->shouldCollapseAlways()])
                    ->class(['d-lg-none' => !$this->shouldCollapseAlways()])
            }}                    
            :class="{ 'laravel-livewire-tables-reorderingMinimised': ! currentlyReorderingStatus }"
        ></th>
    @endif
@endif
