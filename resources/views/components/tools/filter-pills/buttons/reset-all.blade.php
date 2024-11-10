@aware(['isTailwind','isBootstrap','isBootstrap4','isBootstrap5'])
@if ($isTailwind)
    <button
        wire:click.prevent="setFilterDefaults"
        @class([
            "focus:outline-none active:outline-none"
        ])>
        <span @class([
            "inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium",
            "bg-gray-100 text-gray-800 dark:bg-gray-200 dark:text-gray-900"
            ])>
            {{ __('livewire-tables::core.Clear') }}
        </span>
    </button>
@else
    <a
        href="#"
        wire:click.prevent="setFilterDefaults"
        @class([
            'badge badge-pill badge-light' => $isBootstrap4,
            'badge rounded-pill bg-light text-dark text-decoration-none' => $isBootstrap5,
        ])>
        {{ __('livewire-tables::core.Clear') }}
    </a>
@endif
