<button
    {!! count($attributes) ? $column->arrayToAttributes($attributes) : '' !!}
    @if($column->hasConfirmMessage())
        wire:confirm="{{ $column->getConfirmMessage() }}"
    @endif
    @if($column->hasActionCallback())
        wire:click="{{ $path }}"
    @endif
>
    @if($hasIconLeft)
        @svg($iconLeft, $iconLeftAttributes->get('class'), $iconLeftAttributes->except(['class', 'default-styling'])->getAttributes())
    @endif
    @if($column->isHtml())
        {!! $title !!}
    @else
        {{ $title }}
    @endif
    @if($hasIconRight)
        @svg($iconRight, $iconRightAttributes->get('class'), $iconRightAttributes->except(['class', 'default-styling'])->getAttributes())
    @endif
</button>
