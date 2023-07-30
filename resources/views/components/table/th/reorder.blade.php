@aware(['component'])

@if ($this->currentlyReorderingIsEnabled())
    <x-livewire-tables::table.th.plain  x-show="reorderDisplayColumn"/>
@endif
