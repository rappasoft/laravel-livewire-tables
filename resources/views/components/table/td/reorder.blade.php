@aware(['component'])
@props(['rowID', 'rowIndex'])

@if ($this->currentlyReorderingIsEnabled())
<x-livewire-tables::table.td.plain >
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"
        @class([
            'inline w-4 h-4' => $component->isTailwind(),
            'd-inline' => $component->isBootstrap(),
        ])
        @style([
            'width:1em; height:1em;' => $component->isBootstrap(),
        ])
    >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
</x-livewire-tables::table.td.plain>
@endif
