@if($checkbox && $checkboxLocation === 'left')
    @include('laravel-livewire-tables::includes._checkbox-all')
@endif

@foreach($columns as $column)
    <th
        class="{{ $this->setTableHeadClass($column->attribute) }}"
        id="{{ $this->setTableHeadId($column->attribute) }}"
        @foreach ($this->setTableHeadAttributes($column->attribute) as $key => $value)
            {{ $key }}="{{ $value }}"
        @endforeach
    >
        @if($column->sortable)
            <span style="cursor: pointer;" wire:click="sort('{{ $column->attribute }}')">
                {{ $column->text }}

                @if ($sortField !== $column->attribute)
                    <i class="{{ $sortDefaultClass }}"></i>
                @elseif ($sortDirection === 'asc')
                    <i class="{{ $ascSortClass }}"></i>
                @else
                    <i class="{{ $descSortClass }}"></i>
                @endif
            </span>
        @else
            {{ $column->text }}
        @endif
    </th>
@endforeach

@if($checkbox && $checkboxLocation === 'right')
    @include('laravel-livewire-tables::includes._checkbox-all')
@endif
