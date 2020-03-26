@if($checkbox && $checkboxLocation === 'left')
    @include('laravel-livewire-tables::includes._checkbox-all')
@endif

@foreach($columns as $column)
    <th class="{{ $this->thClass($column->attribute) }}">
        @if($column->sortable)
            <span style="cursor: pointer;" wire:click="sort('{{ $column->attribute }}')">
                {{ $column->text }}

                @if ($sortField !== $column->attribute)
                    <i class="text-muted fas fa-sort"></i>
                @elseif ($sortDirection === 'asc')
                    <i class="fas fa-sort-up"></i>
                @else
                    <i class="fas fa-sort-down"></i>
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
