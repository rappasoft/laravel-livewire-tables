<div>
    @if($path)
        <img src="{{ $path }}" {!! count($attributes) ? $column->arrayToAttributes($attributes) : '' !!} />
    @endif
</div>
