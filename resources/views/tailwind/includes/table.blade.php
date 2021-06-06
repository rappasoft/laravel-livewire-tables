<x-livewire-tables::table>
    <x-slot name="head">
        @if (count($bulkActions))
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
                @if ($column->isBlank())
                    <x-livewire-tables::table.heading />
                @else
                    <x-livewire-tables::table.heading
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
        @include('livewire-tables::tailwind.includes.bulk-select-row')

        @forelse ($rows as $index => $row)
            <x-livewire-tables::table.row
                wire:loading.class.delay="opacity-50"
                wire:key="table-row-{{ $row->getKey() }}"
                :url="method_exists($this, 'getTableRowUrl') ? $this->getTableRowUrl($row) : null"
                :class="$index % 2 === 0 ? 'bg-white' . (method_exists($this, 'getTableRowUrl') ? ' hover:bg-gray-100' : '') : 'bg-gray-50' . (method_exists($this, 'getTableRowUrl') ? ' hover:bg-gray-100' : '')"
            >
                @if (count($bulkActions))
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
                <x-livewire-tables::table.cell :colspan="count($bulkActions) ? count($columns) + 1 : count($columns)">
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
