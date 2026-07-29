<button
    {!! count($attributes) ? $column->arrayToAttributes($attributes) : '' !!}
    @if($column->hasConfirmMessage())
        wire:confirm="{{ $column->getConfirmMessage() }}"
    @endif
    @if($column->hasActionCallback())
        wire:click="{{ $path }}"
    @endif
>@if($column->hasIcon() && !$column->getIconRight())<i {{ $column->getIconAttributes()
        ->class([
            'me-1 '. $column->getIcon() => $isBootstrap,
            'mr-1 '. $column->getIcon() => $isTailwind,
        ])
        ->except(['default','default-styling','default-colors']) }}></i>@endif{{ $title }}@if($column->hasIcon() && $column->getIconRight())<i {{ $column->getIconAttributes()
        ->class([
            'ms-1 '. $column->getIcon() => $isBootstrap,
            'ml-1 '. $column->getIcon() => $isTailwind,
        ])
        ->except(['default','default-styling','default-colors']) }}></i>@endif</button>
