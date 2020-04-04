<button type="button"
    @foreach ($attributes as $key => $value)
        {{ $key }}="{{ $value }}"
    @endforeach
>
    @if (array_key_exists('icon', $options))
        <i class="{{ $options['icon'] }}"></i>
    @endif

    {{ $options['text'] ?? '' }}
</button>
