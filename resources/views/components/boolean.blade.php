<span
    @foreach ($attributes as $key => $value)
        {{ $key }}="{{ $value }}"
    @endforeach
>
@php
    $value = $options['jsonKeyVal'] ? ($model->{$options['column']}[$options['key']] || false) : ($model->{$options['column']} || false);
    $true_class = \Arr::get($options, 'icon.true-class', 'text-success');
    $false_class = \Arr::get($options, 'icon.false-class', 'text-danger');
    $true = \Arr::get($options, 'icon.true', 'fas fa-toggle-on');
    $false = \Arr::get($options, 'icon.false', 'fas fa-toggle-off');
    $text = \Arr::get($options, 'text', '');
@endphp
@if($value)
<i class="{{ $true . $true_class }} mx-2"></i>
@else
<i class="{{ $false . $false_class }} mx-2"></i>
@endif
{{ $text }}
</span>