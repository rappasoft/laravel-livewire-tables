@foreach($models as $model)
    <tr
        class="border-b border-gray-200 {{ $this->setTableRowClass($model) }}"
        id="{{ $this->setTableRowId($model) }}"
        @foreach ($this->setTableRowAttributes($model) as $key => $value)
        {{ $key }}="{{ $value }}"
        @endforeach
        @if ($this->getTableRowUrl($model))
            onclick="window.location='{{ $this->getTableRowUrl($model) }}';"
            style="cursor:pointer"
        @endif
    >
        @foreach($columns as $column)
            @if ($column->isVisible())
                <td
                    class="px-6 py-3 whitespace-nowrap text-sm text-gray-500"
                    id="{{ $this->setTableDataId($column->getAttribute(), data_get($model, $column->getAttribute())) }}"
                    @foreach ($this->setTableDataAttributes($column->getAttribute(), data_get($model, $column->getAttribute())) as $key => $value)
                    {{ $key }}="{{ $value }}"
                    @endforeach
                >
                    @if ($column->isFormatted())
                        @if ($column->isRaw())
                            {!! $column->formatted($model, $column) !!}
                        @else
                            {{ $column->formatted($model, $column) }}
                        @endif
                    @else
                        @if ($column->isRaw())
                            {!! data_get($model, $column->getAttribute()) !!}
                        @else
                            {{ data_get($model, $column->getAttribute()) }}
                        @endif
                    @endif
                </td>
            @endif
        @endforeach
    </tr>
@endforeach
