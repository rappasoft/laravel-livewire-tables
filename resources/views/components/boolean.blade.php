<span
    @foreach ($attributes as $key => $value)
        {{ $key }}="{{ $value }}"
    @endforeach
>
@php
    $value = $options['jsonKeyVal'] ? ($model->{$options['column']}[$options['key']] || false) : ($model->{$options['column']} || false);
    $true_class = $options['icon']['true-class'] ? $options['icon']['true-class'] : 'text-success';
    $false_class = $options['icon']['false-class'] ? $options['icon']['false-class'] : 'text-danger';
    $true = $options['icon']['true'] ? '<i class="' . $options['icon']['true'] . $true_class . '"></i>' : '<i class="fas fa-toggle-on ' . $true_class . '"></i>';
    $false = $options['icon']['false'] ? '<i class="' . $options['icon']['false'] . $false_class . '"></i>' : '<i class="fas fa-toggle-off ' . $false_class . '"></i>';
    $text = $options['text'] ?? '';
    if($value) {
        echo $true;
    } else {
        echo $false;
    }
    echo $text;
@endphp
</span>
