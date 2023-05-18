@props(['component'])

@php
    $refresh = $this->getRefreshStatus();
    $theme = $component->getTheme();
@endphp

<div x-data="{
    @if ($component->isFilterLayoutSlideDown()) filtersOpen: $wire.filterSlideDownDefaultVisible, @endif
    selectedItems: $wire.entangle('selected').defer,
    totalItemCount: $wire.entangle('paginationTotalItemCount'),
    visibleItems: {},       
    toggleSelectAll() {
        if (this.totalItemCount == this.selectedItems.length) {
            this.clearSelected()
        } else {
            this.setAllSelected()
        }
    },
    setAllSelected() {
        $wire.setAllSelected();
    },
    clearSelected() {
        $wire.clearSelected();
    },
    selectAllOnPage() {
        let tempSelectedItems = this.selectedItems;
        const iterator = visibleItems.values();
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
