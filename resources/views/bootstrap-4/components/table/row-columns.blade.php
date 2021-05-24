@foreach($columns as $column)
    @if ($column->isVisible())
        <td>
            @if ($column->asHtml)
                {{ new \Illuminate\Support\HtmlString($column->formatted($row)) }}
            @else
                {{ $column->formatted($row) }}
            @endif
        </td>
    @endif
@endforeach
