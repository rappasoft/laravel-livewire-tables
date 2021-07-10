<x-livewire-tables::bs5.table wire:sortable="{{ $reordering ? $reorderingMethod : '' }}">
    <x-slot name="head">
        @if ($reordering)
            <x-livewire-tables::bs5.table.heading />
        @endif

        @if ($bulkActionsEnabled && count($bulkActions))
            <x-livewire-tables::bs5.table.heading>
                <input
                    wire:model="selectPage"
                    class="form-check-input"
                    type="checkbox"
                />
            </x-livewire-tables::bs5.table.heading>
        @endif

        @foreach($columns as $column)
            @if ($column->isVisible())
                @continue($columnSelect && ! $this->isColumnSelectEnabled($column))

                @if ($column->isBlank())
                    <x-livewire-tables::bs5.table.heading />
                @else
                    <x-livewire-tables::bs5.table.heading
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

        @include('livewire-tables::bootstrap-5.includes.bulk-select-row')

        @forelse ($rows as $index => $row)
            <x-livewire-tables::bs5.table.row
                wire:loading.class.delay="text-muted"
                wire:key="table-row-{{ $row->{$primaryKey} }}"
                wire:sortable.item="{{ $row->{$primaryKey} }}"
                :reordering="$reordering"
                :url="method_exists($this, 'getTableRowUrl') ? $this->getTableRowUrl($row) : ''"
                :class="method_exists($this, 'setTableRowClass') ? ' ' . $this->setTableRowClass($row) : ''"
                :id="method_exists($this, 'setTableRowId') ? $this->setTableRowId($row) : ''"
                :customAttributes="method_exists($this, 'setTableRowAttributes') ? $this->setTableRowAttributes($row) : []"
            >
                @if ($reordering)
                    <x-livewire-tables::bs5.table.cell wire:sortable.handle>
                        <svg xmlns="http://www.w3.org/2000/svg" class="d-inline" style="width:1em;height:1em;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </x-livewire-tables::bs5.table.cell>
                @endif

                @if ($bulkActionsEnabled && count($bulkActions))
                    <x-livewire-tables::bs5.table.cell class="align-middle">
                        <input
                            wire:model="selected"
                            wire:loading.attr.delay="disabled"
                            value="{{ $row->{$primaryKey} }}"
                            onclick="event.stopPropagation();return true;"
                            class="form-check-input"
                            type="checkbox"
                        />
                    </x-livewire-tables::bs5.table.cell>
                @endif

                @include($rowView, ['row' => $row])
            </x-livewire-tables::bs5.table.row>
        @empty
            <x-livewire-tables::bs5.table.row>
                <x-livewire-tables::bs5.table.cell :colspan="$colspan">
                    @lang($emptyMessage)
                </x-livewire-tables::bs5.table.cell>
            </x-livewire-tables::bs5.table.row>
        @endforelse
    </x-slot>
</x-livewire-tables::bs5.table>
