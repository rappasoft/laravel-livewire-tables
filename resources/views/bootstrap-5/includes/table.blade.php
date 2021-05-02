<x-livewire-tables::bs5.table>
    <x-slot name="head">
        @if (count($bulkActions))
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
                @if ($column->isBlank())
                    <x-livewire-tables::bs5.table.heading />
                @else
                    <x-livewire-tables::bs5.table.heading
                        :sortable="$column->isSortable()"
                        :column="$column->column()"
                        :direction="$column->column() ? $sorts[$column->column()] ?? null : null"
                        :text="$column->text() ?? ''"
                        :class="$column->class() ?? ''"
                    />
                @endif
            @endif
        @endforeach
    </x-slot>

    <x-slot name="body">
        @if (count($bulkActions) && (($selectPage && $rows->total() > $rows->count()) || count($selected)))
            <x-livewire-tables::bs5.table.row wire:key="row-message">
                <x-livewire-tables::bs5.table.cell colspan="{{ count($bulkActions) ? count($columns) + 1 : count($columns) }}">
                    @if (count($selected) && !$selectAll && !$selectPage)
                        <div>
                            <span>
                                @lang('You have selected')
                                <strong>{{ count($selected) }}</strong>
                                @lang(':rows', ['rows' => count($selected) === 1 ? 'row' : 'rows']).
                            </span>

                            <button
                                wire:click="resetBulk"
                                type="button"
                                class="btn btn-primary btn-sm"
                            >
                                @lang('Unselect All')
                            </button>
                        </div>
                    @elseif ($selectAll)
                        <div>
                            <span>
                                @lang('You are currently selecting all')
                                <strong>{{ number_format($rows->total()) }}</strong>
                                @lang('rows').
                            </span>

                            <button
                                wire:click="resetBulk"
                                type="button"
                                class="btn btn-primary btn-sm"
                            >
                                @lang('Unselect All')
                            </button>
                        </div>
                    @else
                        <div>
                            <span>
                                @lang('You have selected')
                                <strong>{{ $rows->count() }}</strong>
                                @lang('rows, do you want to select all')
                                <strong>{{ number_format($rows->total()) }}</strong>?
                            </span>

                            <button
                                wire:click="selectAll"
                                type="button"
                                class="btn btn-primary btn-sm"
                            >
                                @lang('Select All')
                            </button>
                        </div>
                    @endif
                </x-livewire-tables::bs5.table.cell>
            </x-livewire-tables::bs5.table.row>
        @endif

        @forelse ($rows as $index => $row)
            <x-livewire-tables::bs5.table.row
                wire:loading.class.delay="text-muted"
                wire:key="table-row-{{ $row->getKey() }}"
                :url="method_exists($this, 'getTableRowUrl') ? $this->getTableRowUrl($row) : null"
            >
                @if (count($bulkActions))
                    <x-livewire-tables::bs5.table.cell class="align-middle">
                        <input
                            wire:model="selected"
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
                <x-livewire-tables::bs5.table.cell colspan="{{ count($bulkActions) ? count($columns) + 1 : count($columns) }}">
                    @lang($emptyMessage)
                </x-livewire-tables::bs5.table.cell>
            </x-livewire-tables::bs5.table.row>
        @endforelse
    </x-slot>
</x-livewire-tables::bs5.table>
