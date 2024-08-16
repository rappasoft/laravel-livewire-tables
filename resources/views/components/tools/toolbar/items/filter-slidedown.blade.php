@aware(['component', 'tableName'])
@props([])

<div x-cloak x-show="filtersOpen" 
    @class([
        'container' => $this->isBootstrap,
    ])
    @if($this->isTailwind)
    x-transition:enter="transition ease-out duration-100"
    x-transition:enter-start="transform opacity-0"
    x-transition:enter-end="transform opacity-100"
    x-transition:leave="transition ease-in duration-75"
    x-transition:leave-start="transform opacity-100"
    x-transition:leave-end="transform opacity-0"
    @endif
>
    @foreach ($this->getFiltersByRow() as $filterRowIndex => $filterRow)
        <div
            @class([
                'row col-12' => $this->isBootstrap,
                'grid grid-cols-12 gap-6 px-4 md:p-0 mb-6' => $this->isTailwind,
            ])
            row="{{ $filterRowIndex }}"
        >
            @foreach ($filterRow as $filter)
                <div
                    @class([
                        'space-y-1 mb-4' => 
                            $this->isBootstrap,
                        'col-12 col-sm-9 col-md-6 col-lg-3' => 
                            $this->isBootstrap && 
                            !$filter->hasFilterSlidedownColspan(),
                        'col-12 col-sm-6 col-md-6 col-lg-3' =>
                            $this->isBootstrap &&
                            $filter->hasFilterSlidedownColspan() &&
                            $filter->getFilterSlidedownColspan() == 2,
                        'col-12 col-sm-3 col-md-3 col-lg-3' =>
                            $this->isBootstrap &&
                            $filter->hasFilterSlidedownColspan() &&
                            $filter->getFilterSlidedownColspan() == 3,
                        'col-12 col-sm-1 col-md-1 col-lg-1' =>
                            $this->isBootstrap &&
                            $filter->hasFilterSlidedownColspan() &&
                            $filter->getFilterSlidedownColspan() == 4,
                        'space-y-1 col-span-12' => 
                            $this->isTailwind,
                        'sm:col-span-6 md:col-span-4 lg:col-span-2' => 
                            $this->isTailwind && 
                            !$filter->hasFilterSlidedownColspan(),
                        'sm:col-span-12 md:col-span-8 lg:col-span-4' =>
                            $this->isTailwind &&
                            $filter->hasFilterSlidedownColspan() &&
                            $filter->getFilterSlidedownColspan() == 2,
                        'sm:col-span-9 md:col-span-4 lg:col-span-3' =>
                            $this->isTailwind &&
                            $filter->hasFilterSlidedownColspan() &&
                            $filter->getFilterSlidedownColspan() == 3,
                    ])
                    id="{{ $tableName }}-filter-{{ $filter->getKey() }}-wrapper"
                >
                    {{ $filter->setGenericDisplayData($this->getFilterGenericData)->render() }}
                </div>
            @endforeach
        </div>
    @endforeach
</div>
