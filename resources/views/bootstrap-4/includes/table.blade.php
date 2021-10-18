<x-livewire-tables::bs4.table
    wire:sortable="{{ $reordering ? $reorderingMethod : '' }}"
    :customSecondaryHeader="$secondaryHeader"
    :useHeaderAsFooter="$useHeaderAsFooter"
    :customFooter="$customFooter"
    :class="method_exists($this, 'setTableClass') ? ' ' . $this->setTableClass() : '' "
>
    <x-slot name="head">
        @if ($reordering)
            <x-livewire-tables::bs4.table.heading />
        @endif

        @if ($bulkActionsEnabled && count($this->bulkActions))
            <x-livewire-tables::bs4.table.heading>
                <input
                    wire:model="selectPage"
                    type="checkbox"
                />
            </x-livewire-tables::bs4.table.heading>
        @endif

        @foreach($columns as $column)
            @if ($column->isVisible())
                @continue($columnSelect && ! $this->isColumnSelectEnabled($column))

                @if ($column->isBlank())
                    <x-livewire-tables::bs4.table.heading />
                @else
                    <x-livewire-tables::bs4.table.heading
                        :sortingEnabled="$sortingEnabled"
                        :sortable="$column->isSortable()"
                        :column="$column->column()"
                        :direction="$column->column() ? $sorts[$column->column()] ?? null : null"
                        :text="$column->text() ?? ''"
                        :class="$column->class() ?? ''"
                        :customAttributes="$column->attributes()"
                    />
                @endif
            @endif
        @endforeach
    </x-slot>

    @if ($secondaryHeader)
        <x-slot name="customSecondaryHead">
            <x-livewire-tables::bs4.table.row
                wire:loading.class.delay="opacity-50 dark:bg-gray-900 dark:opacity-60"
                :class="method_exists($this, 'setSecondaryHeaderRowClass') ? ' ' . $this->setSecondaryHeaderRowClass($rows) : ''"
                :id="method_exists($this, 'setSecondaryHeaderRowId') ? $this->setSecondaryHeaderRowId($rows) : ''"
                :customAttributes="method_exists($this, 'setSecondaryHeaderRowAttributes') ? $this->setSecondaryHeaderRowAttributes($rows) : []"
            >
                @if ($reordering)
                    <x-livewire-tables::bs4.table.cell />
                @endif

                @if ($bulkActionsEnabled && count($this->bulkActions))
                    <x-livewire-tables::bs4.table.cell />
                @endif

                @foreach($columns as $column)
                    @if ($column->isVisible())
                        @continue($columnSelect && ! $this->isColumnSelectEnabled($column))

                        @if ($column->hasSecondaryHeader())
                            <x-livewire-tables::bs4.table.cell
                                :class="method_exists($this, 'setSecondaryHeaderDataClass') ? $this->setSecondaryHeaderDataClass($column, $rows) : ''"
                                :id="method_exists($this, 'setSecondaryHeaderDataId') ? $this->setSecondaryHeaderDataId($column, $rows) : ''"
                                :customAttributes="method_exists($this, 'setSecondaryHeaderDataAttributes') ? $this->setSecondaryHeaderDataAttributes($column, $rows) : []"
                            >
                                @if ($column->isHtml())
                                    {{ new \Illuminate\Support\HtmlString($column->secondaryHeaderFormatted($rows)) }}
                                @else
                                    {{ $column->secondaryHeaderFormatted($rows) }}
                                @endif
                            </x-livewire-tables::bs4.table.cell>
                        @else
                            <x-livewire-tables::bs4.table.cell />
                        @endif
                    @endif
                @endforeach
            </x-livewire-tables::bs4.table.row>
        </x-slot>
    @endif

    <x-slot name="body">
        @php
            $colspan = count($columns);
            if ($bulkActionsEnabled && count($this->bulkActions)) $colspan++;
            if ($reordering) $colspan++;
        @endphp

        @include('livewire-tables::bootstrap-4.includes.bulk-select-row')

        @forelse ($rows as $index => $row)
            <x-livewire-tables::bs4.table.row
                wire:loading.class.delay="text-muted"
                wire:key="table-row-{{ $row->{$primaryKey} }}"
                wire:sortable.item="{{ $row->{$primaryKey} }}"
                :reordering="$reordering"
                :url="method_exists($this, 'getTableRowUrl') ? $this->getTableRowUrl($row) : ''"
                :target="method_exists($this, 'getTableRowUrlTarget') ? $this->getTableRowUrlTarget($row) : '_self'"
                :class="method_exists($this, 'setTableRowClass') ? ' ' . $this->setTableRowClass($row) : ''"
                :id="method_exists($this, 'setTableRowId') ? $this->setTableRowId($row) : ''"
                :customAttributes="method_exists($this, 'setTableRowAttributes') ? $this->setTableRowAttributes($row) : []"
            >
                @if ($reordering)
                    <x-livewire-tables::bs4.table.cell wire:sortable.handle>
                        <svg xmlns="http://www.w3.org/2000/svg" class="d-inline" style="width:1em;height:1em;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </x-livewire-tables::bs4.table.cell>
                @endif

                @if ($bulkActionsEnabled && count($this->bulkActions))
                    <x-livewire-tables::bs4.table.cell>
                        <input
                            wire:model="selected"
                            wire:loading.attr.delay="disabled"
                            value="{{ $row->{\Rappasoft\LaravelLivewireTables\Utilities\ColumnUtilities::parseField($primaryKey)} }}"
                            onclick="event.stopPropagation();return true;"
                            type="checkbox"
                        />
                    </x-livewire-tables::bs4.table.cell>
                @endif

                @include($rowView, ['row' => $row])
            </x-livewire-tables::bs4.table.row>
        @empty
            <x-livewire-tables::bs4.table.row>
                <x-livewire-tables::bs4.table.cell :colspan="$colspan">
                    @lang($emptyMessage)
                </x-livewire-tables::bs4.table.cell>
            </x-livewire-tables::bs4.table.row>
        @endforelse
    </x-slot>

    @if ($customFooter)
        <x-slot name="foot">
            <x-livewire-tables::bs4.table.row
                wire:loading.class.delay="text-muted"
                :class="method_exists($this, 'setFooterRowClass') ? ' ' . $this->setFooterRowClass($rows) : ''"
                :id="method_exists($this, 'setFooterRowId') ? $this->setFooterRowId($rows) : ''"
                :customAttributes="method_exists($this, 'setFooterRowAttributes') ? $this->setFooterRowAttributes($rows) : []"
            >
                @if ($reordering)
                    <x-livewire-tables::bs4.table.footer />
                @endif

                @if ($bulkActionsEnabled && count($this->bulkActions))
                    <x-livewire-tables::bs4.table.footer />
                @endif

                @foreach($columns as $column)
                    @if ($column->isVisible())
                        @continue($columnSelect && ! $this->isColumnSelectEnabled($column))

                        @if ($column->hasFooter())
                            <x-livewire-tables::bs4.table.footer
                                :class="method_exists($this, 'setFooterDataClass') ? $this->setFooterDataClass($column, $rows) : ''"
                                :id="method_exists($this, 'setFooterDataId') ? $this->setFooterDataId($column, $rows) : ''"
                                :customAttributes="method_exists($this, 'setFooterDataAttributes') ? $this->setFooterDataAttributes($column, $rows) : []"
                            >
                                @if ($column->isHtml())
                                    {{ new \Illuminate\Support\HtmlString($column->footerFormatted($rows)) }}
                                @else
                                    {{ $column->footerFormatted($rows) }}
                                @endif
                            </x-livewire-tables::bs4.table.footer>
                        @else
                            <x-livewire-tables::bs4.table.footer />
                        @endif
                    @endif
                @endforeach
            </x-livewire-tables::bs4.table.row>
        </x-slot>
    @endif
</x-livewire-tables::bs4.table>
