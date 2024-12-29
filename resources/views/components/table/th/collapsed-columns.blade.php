@aware([ 'tableName','isTailwind','isBootstrap'])

@if ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns())
    <th scope="col" {{
            $attributes->merge()
                ->class(['table-cell dark:bg-gray-800 laravel-livewire-tables-reorderingMinimised' => $isTailwind])
                ->class(['sm:hidden' => $isTailwind && !$this->shouldCollapseOnTablet() && !$this->shouldCollapseAlways()])
                ->class(['md:hidden' => $isTailwind && !$this->shouldCollapseOnMobile() && !$this->shouldCollapseOnTablet() && !$this->shouldCollapseAlways()])
                ->class(['lg:hidden' => $isTailwind &&  !$this->shouldCollapseAlways()])
                ->class(['d-table-cell laravel-livewire-tables-reorderingMinimised' => $isBootstrap])
                ->class(['d-sm-none' => $isBootstrap && !$this->shouldCollapseOnTablet() && !$this->shouldCollapseAlways()])
                ->class(['d-md-none' => $isBootstrap && !$this->shouldCollapseOnMobile() && !$this->shouldCollapseOnTablet() && !$this->shouldCollapseAlways()])
                ->class(['d-lg-none' => $isBootstrap && !$this->shouldCollapseAlways()])

        }}
        :class="{ 'laravel-livewire-tables-reorderingMinimised': ! currentlyReorderingStatus }"
    ></th>
@endif
