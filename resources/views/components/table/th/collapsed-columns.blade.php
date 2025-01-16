@if ($this->collapsingColumnsAreEnabled && $this->hasCollapsedColumns)
    <th scope="col" :class="{ 'laravel-livewire-tables-reorderingMinimised': ! currentlyReorderingStatus }" {{
        $attributes->merge()
            ->class([
                'table-cell dark:bg-gray-800 laravel-livewire-tables-reorderingMinimised' => $this->isTailwind,
                'sm:hidden' => $this->isTailwind && !$this->shouldCollapseOnTablet && !$this->shouldCollapseAlways,
                'md:hidden' => $this->isTailwind && !$this->shouldCollapseOnMobile && !$this->shouldCollapseOnTablet && !$this->shouldCollapseAlways,
                'lg:hidden' => $this->isTailwind && !$this->shouldCollapseAlways,
                'd-table-cell laravel-livewire-tables-reorderingMinimised' => $this->isBootstrap,
                'd-sm-none' => $this->isBootstrap && !$this->shouldCollapseOnTablet && !$this->shouldCollapseAlways,
                'd-md-none' => $this->isBootstrap && !$this->shouldCollapseOnMobile && !$this->shouldCollapseOnTablet && !$this->shouldCollapseAlways,
                'd-lg-none' => $this->isBootstrap && !$this->shouldCollapseAlways,
            ])
        }}></th>
@endif
