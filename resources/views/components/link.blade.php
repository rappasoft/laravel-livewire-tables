<a
    @foreach ($attributes as $key => $value)
        @if ($key === 'href' && is_callable($value))
            {{ $key }}="{{ app()->call($value, ['model' => $model]) }}"
        @else
            {{ $key }}="{{ $value }}"
        @endif
    @endforeach
>
    @if (array_key_exists('icon', $options))
        <i class="{{ $options['icon'] }}"></i>
    @endif

    {{ $options['text'] ?? '' }}
</a>
