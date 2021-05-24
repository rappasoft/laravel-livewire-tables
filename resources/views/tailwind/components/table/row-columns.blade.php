@foreach($columns as $column)
    @if ($column->isVisible())
        <x-livewire-tables::table.cell>
            @if ($column->asHtml)
                {{ new \Illuminate\Support\HtmlString($column->formatted($row)) }}
            @else
                {{ $column->formatted($row) }}
            @endif
        </x-livewire-tables::table.cell>
    @endif
@endforeach
