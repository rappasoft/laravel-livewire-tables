@props(['component'])

@php
    $refresh = $this->getRefreshStatus();
    $theme = $component->getTheme();
@endphp

 <div x-data="{ 
            @if ($component->isFilterLayoutSlideDown()) filtersOpen: $wire.filterSlideDownDefaultVisible, @endif
            @if ($component->bulkActionsAreEnabled())
            selectedItems: $wire.entangle('selected'),
            visibleItems: {},
            selectAllOnPage() {
                let tempSelectedItems = this.selectedItems;
                const iterator = visibleItems.values();
                for (const value of iterator) {
                    tempSelectedItems.push(value.toString());
                }
                this.selectedItems = [...new Set(tempSelectedItems)];
            },
            @endif
        }">
    <div
        {{ $attributes->merge($this->getComponentWrapperAttributes()) }}

        @if ($component->hasRefresh())
            wire:poll{{ $component->getRefreshOptions() }}
        @endif

        @if ($component->isFilterLayoutSlideDown())
            wire:ignore.self 
        @endif
    >
         @include('livewire-tables::includes.debug')
         @include('livewire-tables::includes.offline')

         {{ $slot }}
    </div>
</div>
