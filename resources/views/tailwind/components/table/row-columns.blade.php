@php /** @var \Rappasoft\LaravelLivewireTables\Views\Column[] $columns **/ @endphp
@foreach($columns as $column)
    <td>
        @if($column->asHtml)
            {!! (string)$column->formatted($row) !!}
        @else
            {{ $column->formatted($row) }}
        @endif
    </td>
@endforeach
