@aware(['component'])

@if ($component->collapsingColumnsAreEnabled() && $component->hasCollapsedColumns())
    @php
        $theme = $component->getTheme();
        $hasCollapseOnAllColumn = $component->getCollapsedColumnsCount();
    @endphp

    @if ($theme === 'tailwind')
        <th
            scope="col"
            {{
                $attributes
                    ->merge(['class' => 'table-cell dark:bg-gray-800'])
                    ->class(['' => $hasCollapseOnAllColumn ])
                    ->class([
                        'md:hidden' => !$hasCollapseOnAllColumn && (
                            (($component->shouldCollapseOnMobile() && $component->shouldCollapseOnTablet()) ||
                            ($component->shouldCollapseOnTablet() && ! $component->shouldCollapseOnMobile())))
                    ])
                    ->class(['sm:hidden' => !$hasCollapseOnAllColumn && ($component->shouldCollapseOnMobile() && ! $component->shouldCollapseOnTablet())])
            }}
        ></th>
    @elseif ($theme === 'bootstrap-4' || $theme === 'bootstrap-5')
        <th
            scope="col"
            {{
                $attributes
                    ->merge(['class' => 'd-table-cell'])
                    ->class(['' => $hasCollapseOnAllColumn ])
                    ->class([
                        'd-md-none' => !$hasCollapseOnAllColumn && (
                            (($component->shouldCollapseOnMobile() && $component->shouldCollapseOnTablet()) ||
                            ($component->shouldCollapseOnTablet() && ! $component->shouldCollapseOnMobile())))
                    ])
                    ->class(['d-sm-none' => !$hasCollapseOnAllColumn && ($component->shouldCollapseOnMobile() && ! $component->shouldCollapseOnTablet())])
            }}
        >Test</th>
    @endif
@endif
