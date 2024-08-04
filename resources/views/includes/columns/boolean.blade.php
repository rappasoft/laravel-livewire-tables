@if ($component->isTailwind())
    @if ($status)
        @if ($type === 'icons')
            @if ($successValue === true)
                <x-heroicon-o-check-circle class="inline-block h-5 w-5 text-green-500" />
            @else
                <x-heroicon-o-check-circle class="inline-block h-5 w-5 text-red-500" />
            @endif
        @elseif ($type === 'yes-no')
            @if ($successValue === true)
                <span>Yes</span>
            @else
                <span>No</span>
            @endif
        @endif
    @else
        @if ($type === 'icons')
            @if ($successValue === false)
                <x-heroicon-o-x-circle class="inline-block h-5 w-5 text-green-500" />
            @else
                <x-heroicon-o-x-circle class="inline-block h-5 w-5 text-red-500" />
            @endif
        @elseif ($type === 'yes-no')
            @if ($successValue === false)
                <span>Yes</span>
            @else
                <span>No</span>
            @endif
        @endif
    @endif
@elseif ($component->isBootstrap())
    @if ($status)
        @if ($type === 'icons')
            @if ($successValue === true)
                <x-heroicon-o-check-circle  class="d-inline-block text-success laravel-livewire-tables-btn-small" />
            @else
                <x-heroicon-o-check-circle class="d-inline-block text-danger laravel-livewire-tables-btn-small" />
            @endif
        @elseif ($type === 'yes-no')
            @if ($successValue === true)
                <span>Yes</span>
            @else
                <span>No</span>
            @endif
        @endif
    @else
        @if ($type === 'icons')
            @if ($successValue === false)
                <x-heroicon-o-x-circle class="d-inline-block text-success laravel-livewire-tables-btn-small" />
            @else
                <x-heroicon-o-x-circle class="d-inline-block text-danger laravel-livewire-tables-btn-small" />
            @endif
        @elseif ($type === 'yes-no')
            @if ($successValue === false)
                <span>Yes</span>
            @else
                <span>No</span>
            @endif
        @endif
    @endif
@endif
