<x-livewire-tables::table wire:sortable="{{ $reordering ? $reorderingMethod : '' }}">
    <x-slot name="head">
        @if ($reordering)
            <x-livewire-tables::table.heading />
        @endif

        @if ($bulkActionsEnabled && count($bulkActions))
            <x-livewire-tables::table.heading>
                <div class="inline-flex rounded-md shadow-sm">
                    <input
                        wire:model="selectPage"
                        type="checkbox"
                        class="rounded-md shadow-sm border-gray-300 block transition duration-150 ease-in-out sm:text-sm sm:leading-5"
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

    <x-slot name="body">
        @php
            $colspan = count($columns);
            if ($bulkActionsEnabled && count($bulkActions)) $colspan++;
            if ($reordering) $colspan++;
        @endphp

        @include('livewire-tables::tailwind.includes.bulk-select-row')

        @forelse ($rows as $index => $row)
            <x-livewire-tables::table.row
                wire:loading.class.delay="opacity-50"
                wire:key="table-row-{{ $row->{$primaryKey} }}"
                wire:sortable.item="{{ $row->{$primaryKey} }}"
                :reordering="$reordering"
                :url="method_exists($this, 'getTableRowUrl') ? $this->getTableRowUrl($row) : ''"
                :class="
                    ($index % 2 === 0 ?
                    'bg-white' . (method_exists($this, 'getTableRowUrl') ? ' hover:bg-gray-100' : '') :
                    'bg-gray-50') .
                    (method_exists($this, 'getTableRowUrl') ? ' hover:bg-gray-100' : '') .
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

                @if ($bulkActionsEnabled && count($bulkActions))
                    <x-livewire-tables::table.cell>
                        <div class="inline-flex rounded-md shadow-sm">
                            <input
                                wire:model="selected"
                                wire:loading.attr.delay="disabled"
                                value="{{ $row->{$primaryKey} }}"
                                onclick="event.stopPropagation();return true;"
                                type="checkbox"
                                class="rounded-md shadow-sm border-gray-300 block transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                            />
                        </div>
                    </x-livewire-tables::table.cell>
                @endif

                @include($rowView)
            </x-livewire-tables::table.row>
        @empty
            <x-livewire-tables::table.row>
                <x-livewire-tables::table.cell :colspan="$colspan">
                    <div class="flex justify-center items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>

                        <span class="font-medium py-8 text-gray-400 text-xl">@lang($emptyMessage)</span>
                    </div>
                </x-livewire-tables::table.cell>
            </x-livewire-tables::table.row>
        @endforelse
    </x-slot>
</x-livewire-tables::table>
