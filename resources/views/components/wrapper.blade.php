@props(['component', 'theme'])

@php
    $refresh = $this->getRefreshStatus();
@endphp

<div x-data="{
    @if ($component->isFilterLayoutSlideDown()) filtersOpen: $wire.filterSlideDownDefaultVisible, @endif
    paginationCurrentCount: $wire.entangle('paginationCurrentCount').live,
    paginationTotalItemCount: $wire.entangle('paginationTotalItemCount').live,
    paginationCurrentItems: $wire.entangle('paginationCurrentItems').live,
    alwaysShowBulkActions: {{ $component->getHideBulkActionsWhenEmptyStatus() ? 'false' : 'true' }},
    selectedItems: $wire.entangle('selected'),
    toggleSelectAll() {
        @if (! $component->showBulkActionsDropdownAlpine())
            return;
        @endif

        if (this.paginationTotalItemCount == this.selectedItems.length) {
            this.clearSelected();
        } else {
            this.setAllSelected();
        }
    },
    setAllSelected() {
        @if (! $component->showBulkActionsDropdownAlpine())
            return;
        @endif

        $wire.setAllSelected();
    },
    clearSelected() {
        @if (! $component->showBulkActionsDropdownAlpine())
            return;
        @endif

        $wire.clearSelected();
    },
    selectAllOnPage() {
        @if (! $component->showBulkActionsDropdownAlpine())
            return;
        @endif

        let tempSelectedItems = this.selectedItems;
        const iterator = this.paginationCurrentItems.values();
        for (const value of iterator) {
            tempSelectedItems.push(value.toString());
        }
        this.selectedItems = [...new Set(tempSelectedItems)];
    },
}">
    <div {{ $attributes->merge($this->getComponentWrapperAttributes()) }}
        @if ($component->hasRefresh()) wire:poll{{ $component->getRefreshOptions() }} @endif
        @if ($component->isFilterLayoutSlideDown()) wire:ignore.self @endif>

        @include('livewire-tables::includes.debug')
        @include('livewire-tables::includes.offline')

        {{ $slot }}
    </div>
</div>
