@aware(['component', 'theme'])

@if ($this->currentlyReorderingIsEnabled())
    <x-livewire-tables::table.th.plain />
@endif
