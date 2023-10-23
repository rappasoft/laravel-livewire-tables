@aware(['component', 'tableName'])
    <div
        x-cloak
        x-show="filtersOpen"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0"
        x-transition:enter-end="transform opacity-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100"
        x-transition:leave-end="transform opacity-0"
    >
        @foreach ($component->getFiltersByRow() as $filterRowIndex => $filterRow)
            <div
                row="{{ $filterRowIndex }}"
                class="grid grid-cols-12 gap-6 px-4 md:p-0 mb-6"
                @class([
                    'col-span-12  sm:col-span-12 sm:col-span-6 sm:col-span-3 sm:col-span-1 md:col-span-12 md:col-span-6 md:col-span-3 md:col-span-1 lg:col-span-12 lg:col-span-6 lg:col-span-3 lg:col-span-1 row-start-1 row-start-2 row-start-3 row-start-4 row-start-5 row-start-6 row-start-7 row-start-8 row-start9' => true == false,
                ])
            >
                @foreach ($filterRow as $filter)
                    <div @class([
                            'space-y-1 col-span-12',
                            'sm:col-span-6 md:col-span-4 lg:col-span-2' => !$filter->hasFilterSlidedownColspan(),
                            'sm:col-span-12 md:col-span-8 lg:col-span-4' =>
                                $filter->hasFilterSlidedownColspan() &&
                                $filter->getFilterSlidedownColspan() == 2,
                            'sm:col-span-9 md:col-span-4 lg:col-span-3' =>
                                $filter->hasFilterSlidedownColspan() &&
                                $filter->getFilterSlidedownColspan() == 3,
                            ])
                         id="{{ $tableName }}-filter-{{ $filter->getKey() }}-wrapper"
                    >
                        {{ $filter->render($component->filterLayout, $tableName, $component->isTailwind(), $component->isBootstrap4(), $component->isBootstrap5()) }}
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
