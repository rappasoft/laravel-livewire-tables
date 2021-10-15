<x-livewire-tables::table
    wire:sortable="{{ $reordering ? $reorderingMethod : '' }}"
    :customSecondaryHeader="$secondaryHeader"
    :useHeaderAsFooter="$useHeaderAsFooter"
    :customFooter="$customFooter"
    :class="method_exists($this, 'setTableClass') ? ' ' . $this->setTableClass() : '' "
>
    <x-slot name="head">
        @if ($reordering)
            <x-livewire-tables::table.heading />
        @endif

        @if ($bulkActionsEnabled && count($this->bulkActions))
            <x-livewire-tables::table.heading>
                <div class="inline-flex rounded-md shadow-sm">
                    <input
                        wire:model="selectPage"
                        type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm transition duration-150 ease-in-out focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600"
                    />
                </div>
            </x-livewire-tables::table.heading>
        @endif

        @foreach($columns as $column)
            @if ($column->isVisible())
                @continue($columnSelect && ! $this->isColumnSelectEnabled($column))

                @if ($column->isBlank())
                    <x-livewire-tables::table.heading />
                @else
                    <x-livewire-tables::table.heading
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
            <x-livewire-tables::table.row
                wire:loading.class.delay="opacity-50 dark:bg-gray-900 dark:opacity-60"
                :class="method_exists($this, 'setSecondaryHeaderRowClass') ? ' ' . $this->setSecondaryHeaderRowClass($rows) : ''"
                :id="method_exists($this, 'setSecondaryHeaderRowId') ? $this->setSecondaryHeaderRowId($rows) : ''"
                :customAttributes="method_exists($this, 'setSecondaryHeaderRowAttributes') ? $this->setSecondaryHeaderRowAttributes($rows) : []"
            >
                @if ($reordering)
                    <x-livewire-tables::table.cell />
                @endif

                @if ($bulkActionsEnabled && count($this->bulkActions))
                    <x-livewire-tables::table.cell />
                @endif

                @foreach($columns as $column)
                    @if ($column->isVisible())
                        @continue($columnSelect && ! $this->isColumnSelectEnabled($column))

                        @if ($column->hasSecondaryHeader())
                            <x-livewire-tables::table.cell
                                :class="method_exists($this, 'setSecondaryHeaderDataClass') ? $this->setSecondaryHeaderDataClass($column, $rows) : ''"
                                :id="method_exists($this, 'setSecondaryHeaderDataId') ? $this->setSecondaryHeaderDataId($column, $rows) : ''"
                                :customAttributes="method_exists($this, 'setSecondaryHeaderDataAttributes') ? $this->setSecondaryHeaderDataAttributes($column, $rows) : []"
                            >
                                @if ($column->isHtml())
                                    {{ new \Illuminate\Support\HtmlString($column->secondaryHeaderFormatted($rows)) }}
                                @else
                                    {{ $column->secondaryHeaderFormatted($rows) }}
                                @endif
                            </x-livewire-tables::table.cell>
                        @else
                            <x-livewire-tables::table.cell />
                        @endif
                    @endif
                @endforeach
            </x-livewire-tables::table.row>
        </x-slot>
    @endif

    <x-slot name="body">
        @php
            $colspan = count($columns);
            if ($bulkActionsEnabled && count($this->bulkActions)) $colspan++;
            if ($reordering) $colspan++;
        @endphp

        @include('livewire-tables::tailwind.includes.bulk-select-row')

        @forelse ($rows as $index => $row)
            <x-livewire-tables::table.row
                wire:loading.class.delay="opacity-50 dark:bg-gray-900 dark:opacity-60"
                wire:key="table-row-{{ $row->{$primaryKey} }}"
                wire:sortable.item="{{ $row->{$primaryKey} }}"
                :reordering="$reordering"
                :url="method_exists($this, 'getTableRowUrl') ? $this->getTableRowUrl($row) : ''"
                :target="method_exists($this, 'getTableRowUrlTarget') ? $this->getTableRowUrlTarget($row) : '_self'"
                :class="
                    ($index % 2 === 0 ?
                    'bg-white dark:bg-gray-700 dark:text-white' . (method_exists($this, 'getTableRowUrl') ? ' hover:bg-gray-100' : '') :
                    'bg-gray-50 dark:bg-gray-800 dark:text-white') .
                    (method_exists($this, 'getTableRowUrl') ? ' hover:bg-gray-100 dark:hover:bg-gray-900 transition' : '') .
                    (method_exists($this, 'setTableRowClass') ? ' ' . $this->setTableRowClass($row) : '')
                "
                :id="method_exists($this, 'setTableRowId') ? $this->setTableRowId($row) : ''"
                :customAttributes="method_exists($this, 'setTableRowAttributes') ? $this->setTableRowAttributes($row) : []"
            >
                @if ($reordering)
                    <x-livewire-tables::table.cell wire:sortable.handle>
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline" style="width:1em;height:1em;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </x-livewire-tables::table.cell>
                @endif

                @if ($bulkActionsEnabled && count($this->bulkActions))
                    <x-livewire-tables::table.cell>
                        <div class="inline-flex rounded-md shadow-sm">
                            <input
                                wire:model="selected"
                                wire:loading.attr.delay="disabled"
                                value="{{ $row->{\Rappasoft\LaravelLivewireTables\Utilities\ColumnUtilities::parseField($primaryKey)} }}"
                                onclick="event.stopPropagation();return true;"
                                type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm transition duration-150 ease-in-out focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600"
                            />
                        </div>
                    </x-livewire-tables::table.cell>
                @endif

                @include($rowView)
            </x-livewire-tables::table.row>
        @empty
            <x-livewire-tables::table.row>
                <x-livewire-tables::table.cell :colspan="$colspan" class="dark:bg-gray-800">
                    <div class="flex justify-center items-center space-x-2 dark:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>

                        <span class="font-medium py-8 text-gray-400 text-xl dark:text-white">@lang($emptyMessage)</span>
                    </div>
                </x-livewire-tables::table.cell>
            </x-livewire-tables::table.row>
        @endforelse
    </x-slot>

    @if ($customFooter)
        <x-slot name="foot">
            <x-livewire-tables::table.row
                wire:loading.class.delay="opacity-50 dark:bg-gray-900 dark:opacity-60"
                :class="method_exists($this, 'setFooterRowClass') ? ' ' . $this->setFooterRowClass($rows) : ''"
                :id="method_exists($this, 'setFooterRowId') ? $this->setFooterRowId($rows) : ''"
                :customAttributes="method_exists($this, 'setFooterRowAttributes') ? $this->setFooterRowAttributes($rows) : []"
            >
                @if ($reordering)
                    <x-livewire-tables::table.footer />
                @endif

                @if ($bulkActionsEnabled && count($this->bulkActions))
                    <x-livewire-tables::table.footer />
                @endif

                @foreach($columns as $column)
                    @if ($column->isVisible())
                        @continue($columnSelect && ! $this->isColumnSelectEnabled($column))

                        @if ($column->hasFooter())
                            <x-livewire-tables::table.footer
                                :class="method_exists($this, 'setFooterDataClass') ? $this->setFooterDataClass($column, $rows) : ''"
                                :id="method_exists($this, 'setFooterDataId') ? $this->setFooterDataId($column, $rows) : ''"
                                :customAttributes="method_exists($this, 'setFooterDataAttributes') ? $this->setFooterDataAttributes($column, $rows) : []"
                            >
                                @if ($column->isHtml())
                                    {{ new \Illuminate\Support\HtmlString($column->footerFormatted($rows)) }}
                                @else
                                    {{ $column->footerFormatted($rows) }}
                                @endif
                            </x-livewire-tables::table.footer>
                        @else
                            <x-livewire-tables::table.footer />
                        @endif
                    @endif
                @endforeach
            </x-livewire-tables::table.row>
        </x-slot>
    @endif
</x-livewire-tables::table>
