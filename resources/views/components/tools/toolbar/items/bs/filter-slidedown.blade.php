@aware(['component', 'tableName'])
    <div x-show="!currentlyReorderingStatus">
        <div x-cloak x-show="filtersOpen">
            <div @class([
                'container' => $component->isBootstrap(),
            ])>
                @foreach ($component->getFiltersByRow() as $filterRowIndex => $filterRow)
                    <div
                        @class([
                            'row col-12' => $component->isBootstrap(),
                        ])
                        row="{{ $filterRowIndex }}"
                    >
                        @foreach ($filterRow as $filter)
                            <div
                                @class([
                                    'space-y-1 mb-4',
                                    'col-12 col-sm-9 col-md-6 col-lg-3' => !$filter->hasFilterSlidedownColspan(),
                                    'col-12 col-sm-6 col-md-6 col-lg-3' =>
                                        $filter->hasFilterSlidedownColspan() &&
                                        $filter->getFilterSlidedownColspan() == 2,
                                    'col-12 col-sm-3 col-md-3 col-lg-3' =>
                                        $filter->hasFilterSlidedownColspan() &&
                                        $filter->getFilterSlidedownColspan() == 3,
                                    'col-12 col-sm-1 col-md-1 col-lg-1' =>
                                        $filter->hasFilterSlidedownColspan() &&
                                        $filter->getFilterSlidedownColspan() == 4,
                                ])
                                id="{{ $tableName }}-filter-{{ $filter->getKey() }}-wrapper"
                            >
                                {{ $filter->render($component->filterLayout, $tableName, $component->isTailwind(), $component->isBootstrap4(), $component->isBootstrap5()) }}
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
