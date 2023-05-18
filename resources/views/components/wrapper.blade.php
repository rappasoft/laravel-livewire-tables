@props(['component'])

@php
    $refresh = $this->getRefreshStatus();
    $theme = $component->getTheme();
@endphp

<div x-data="{
    shouldShowBulkActionSelect: false,
    @if ($component->isFilterLayoutSlideDown()) filtersOpen: $wire.filterSlideDownDefaultVisible, @endif
        selectedItems: $wire.entangle('selected').defer,
        selectedCount: 0,
        totalItems: 0,
        visibleItems: {},
        allItemsSelected: false,
        toggleSelectAll() {
            if (this.totalItems == this.selectedCount) {
                this.clearSelected()
            } else {
                this.setAllSelected()
            }
        },
        setAllSelected() {
            allItemsSelected = true;
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
        updateTotalItemCount(itemCount) {
            this.totalItems = itemCount;
            this.allItemsSelected = (itemCount == this.selectedCount);
        },
}"
    x-init="selectedCount = selectedItems.length; shouldShowBulkActionSelect = (selectedCount > 0);"
    x-effect="selectedCount = selectedItems.length; shouldShowBulkActionSelect = (selectedItems.length > 0);">
    <div {{ $attributes->merge($this->getComponentWrapperAttributes()) }}
        @if ($component->hasRefresh()) wire:poll{{ $component->getRefreshOptions() }} @endif
        @if ($component->isFilterLayoutSlideDown()) wire:ignore.self @endif>
        @include('livewire-tables::includes.debug')
        @include('livewire-tables::includes.offline')

        {{ $slot }}
    </div>
</div>
