@aware(['component', 'tableName', 'primaryKey','isTailwind','isBootstrap'])
@props(['row', 'rowIndex'])

@php
    $customAttributes = $this->getTrAttributes($row, $rowIndex);
@endphp

@if ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns())
    @php
        $colspan = $this->getColspanCount();
        $columns = collect();

        if($this->shouldCollapseAlways())
        {
            $columns->push($this->getCollapsedAlwaysColumns());
        }
        if ($this->shouldCollapseOnMobile() && $this->shouldCollapseOnTablet()) {
            $columns->push($this->getCollapsedMobileColumns());
            $columns->push($this->getCollapsedTabletColumns());
        } elseif ($this->shouldCollapseOnTablet() && ! $this->shouldCollapseOnMobile()) {
            $columns->push($this->getCollapsedTabletColumns());
        } elseif ($this->shouldCollapseOnMobile() && ! $this->shouldCollapseOnTablet()) {
            $columns->push($this->getCollapsedMobileColumns());
        }

        $columns = $columns->collapse();
    @endphp

    <tr
        x-data
        @toggle-row-content.window="($event.detail.tableName === '{{ $tableName }}' && $event.detail.row === {{ $rowIndex }}) ? $el.classList.toggle('{{ $isBootstrap ? 'd-none' : 'hidden' }}') : null"

        wire:key="{{ $tableName }}-row-{{ $row->{$primaryKey} }}-collapsed-contents"
        wire:loading.class.delay="opacity-50 dark:bg-gray-900 dark:opacity-60"
        {{
        $attributes->merge($customAttributes)
                ->class(['hidden bg-white dark:bg-gray-700 dark:text-white rappasoft-striped-row' => ($isTailwind && ($customAttributes['default'] ?? true) && $rowIndex % 2 === 0)])
                ->class(['hidden bg-gray-50 dark:bg-gray-800 dark:text-white rappasoft-striped-row' => ($isTailwind && ($customAttributes['default'] ?? true) && $rowIndex % 2 !== 0)])
                ->class(['d-none bg-light rappasoft-striped-row' => ($isBootstrap && $rowIndex % 2 === 0 && ($customAttributes['default'] ?? true))])
                ->class(['d-none bg-white rappasoft-striped-row' => ($isBootstrap && $rowIndex % 2 !== 0 && ($customAttributes['default'] ?? true))])
                ->except(['default','default-styling','default-colors'])
        }}

    >
        <td
            @class([
                'text-left pt-4 pb-2 px-4' => $isTailwind,
                'text-start pt-3 p-2' => $isBootstrap,
            ])
            colspan="{{ $colspan }}"
        >
            <div>
                @foreach($columns as $colIndex => $column)
                    @continue($column->isHidden())
                    @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))

                    <p wire:key="{{ $tableName }}-row-{{ $row->{$primaryKey} }}-collapsed-contents-{{ $colIndex }}"

                        @class([
                            'block mb-2' => $isTailwind && $column->shouldCollapseAlways(),
                            'block mb-2 sm:hidden' => $isTailwind && !$column->shouldCollapseAlways() && !$column->shouldCollapseOnTablet() && !$column->shouldCollapseOnMobile(),
                            'block mb-2 md:hidden' => $isTailwind && !$column->shouldCollapseAlways() && !$column->shouldCollapseOnTablet() && $column->shouldCollapseOnMobile(),
                            'block mb-2 lg:hidden' => $isTailwind && !$column->shouldCollapseAlways() && ($column->shouldCollapseOnTablet() || $column->shouldCollapseOnMobile()),

                            'd-block mb-2' => $isBootstrap && $column->shouldCollapseAlways(),
                            'd-block mb-2 d-sm-none' => $isBootstrap && !$column->shouldCollapseAlways() && !$column->shouldCollapseOnTablet() && !$column->shouldCollapseOnMobile(),
                            'd-block mb-2 d-md-none' => $isBootstrap && !$column->shouldCollapseAlways() && !$column->shouldCollapseOnTablet() && $column->shouldCollapseOnMobile(),
                            'd-block mb-2 d-lg-none' => $isBootstrap && !$column->shouldCollapseAlways() && ($column->shouldCollapseOnTablet() || $column->shouldCollapseOnMobile()),

                        ])
                    >
                        <strong>{{ $column->getTitle() }}</strong>: {{ $column->renderContents($row) }}
                    </p>
                @endforeach
            </div>
        </td>
    </tr>
@endif
