@props(['direction'])
<span {{ $attributes->class([
        'relative flex items-center' => $this->isTailwind,
        'relative d-flex align-items-center' => $this->isBootstrap
    ]) }}
>
    @if($this->isTailwind)
        @switch($direction)
            @case('asc')
                <x-heroicon-o-chevron-up class="w-3 h-3 group-hover:opacity-0" />
                <x-heroicon-o-chevron-down class="w-3 h-3 opacity-0 group-hover:opacity-100 absolute"/>
                @break
            @case('desc')
                <x-heroicon-o-chevron-down class="w-3 h-3 group-hover:opacity-0" />
                <x-heroicon-o-x-circle class="w-3 h-3 opacity-0 group-hover:opacity-100 absolute"/>
                @break
            @default
                <x-heroicon-o-chevron-up class="w-3 h-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300" />
        @endswitch
    @else
        @switch($direction)
            @case('asc')
                <x-heroicon-o-chevron-up class="laravel-livewire-tables-btn-smaller ms-1 "  />
                @break
            @case('desc')
                <x-heroicon-o-chevron-down class="laravel-livewire-tables-btn-smaller ms-1"  />
            @break
            @default
                <x-heroicon-o-chevron-up-down class="laravel-livewire-tables-btn-smaller ms-1" />
        @endswitch
    @endif
</span>
