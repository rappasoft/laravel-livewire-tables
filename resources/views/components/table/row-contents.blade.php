@aware(['component'])
@props(['row', 'rowIndex'])

@if ($component->collapsingColumnsAreEnabled() && $component->hasCollapsedColumns())
    @php
        $columns = collect([]);

        if ($component->shouldCollapseOnMobile() && $component->shouldCollapseOnTablet()) {
            $columns->push($component->getCollapsedMobileColumns());
            $columns->push($component->getCollapsedTabletColumns());
        } elseif ($component->shouldCollapseOnTablet() && ! $component->shouldCollapseOnMobile()) {
            $columns->push($component->getCollapsedTabletColumns());
        } elseif ($component->shouldCollapseOnMobile() && ! $component->shouldCollapseOnTablet()) {
            $columns->push($component->getCollapsedMobileColumns());
        }

        $columns = $columns->collapse();

        // TODO: Column count
        $colspan = $columns->count() + 1;
    @endphp

    <tr
        wire:key="row-{{ $rowIndex }}-collapsed-contents"
        wire:loading.class.delay="opacity-50 dark:bg-gray-900 dark:opacity-60"
        x-data
        @toggle-row-content.window="$event.detail.row === {{ $rowIndex }} ? $el.classList.toggle('hidden') : null"
        @class([
            'hidden md:hidden bg-white dark:bg-gray-700 dark:text-white' => $component->isTailwind(),
            'd-none d-md-none' => $component->isBootstrap()
        ])
    >
        <td
            @class([
                'pt-4 pb-2 px-4' => $component->isTailwind(),
                'pt-3 p-2' => $component->isBootstrap(),
            ])
            colspan="{{ $colspan }}">
            <div>
                @foreach($columns as $colIndex => $column)
                    @continue($column->isHidden())
                    @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))

                    <p
                        @class([
                            'block mb-2 sm:hidden' => $component->isTailwind() && $column->shouldCollapseOnMobile(),
                            'block mb-2 md:hidden' => $component->isTailwind() && $column->shouldCollapseOnTablet(),
                            'd-block mb-2 d-sm-none' => $component->isBootstrap() && $column->shouldCollapseOnMobile(),
                            'd-block mb-2 d-md-none' => $component->isBootstrap() && $column->shouldCollapseOnTablet(),
                        ])
                    >
                        <strong>{{ $column->getTitle() }}</strong>: {{ $column->renderContents($row) }}
                    </p>
                @endforeach
            </div>
        </td>
    </tr>
@endif
