@foreach($columns as $column)
    @if ($column->isVisible())
        @continue($columnSelect && ! $this->isColumnSelectEnabled($column))

        <x-livewire-tables::table.cell
            :class="method_exists($this, 'setTableDataClass') ? $this->setTableDataClass($column, $row) : ''"
            :id="method_exists($this, 'setTableDataId') ? $this->setTableDataId($column, $row) : ''"
            :customAttributes="method_exists($this, 'setTableDataAttributes') ? $this->setTableDataAttributes($column, $row) : []"
        >
            @if ($column->isHtml())
                {{ new \Illuminate\Support\HtmlString($column->formatted($row)) }}
            @else
                {{ $column->formatted($row) }}
            @endif
        </x-livewire-tables::table.cell>
    @endif
@endforeach
