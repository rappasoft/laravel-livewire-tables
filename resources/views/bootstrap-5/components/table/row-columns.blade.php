@foreach($columns as $column)
    <td>
        @if ($column->asHtml)
            {{ new \Illuminate\Support\HtmlString($column->formatted($row)) }}
        @else
            {{ $column->formatted($row) }}
        @endif
    </td>
@endforeach
