@php /** @var \Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn $column */ @endphp

<a href="{{ $path }}" {!! count($attributes) ? $column->arrayToAttributes($attributes) : '' !!}>
    @if($column->isHtml())
        {!! $title !!}
    @else
        {{ $title }}
    @endif
</a>
