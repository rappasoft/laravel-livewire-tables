@props(['component'])

@php
    $refresh = $this->getRefreshStatus();
@endphp

<div x-data="tableWrapper($wire, {{ $component->showBulkActionsDropdownAlpine() }})">
    <div {{ $attributes->merge($this->getComponentWrapperAttributes()) }}
        @if ($component->hasRefresh()) wire:poll{{ $component->getRefreshOptions() }} @endif
        @if ($component->isFilterLayoutSlideDown()) wire:ignore.self @endif>

        @include('livewire-tables::includes.debug')
        @include('livewire-tables::includes.offline')

        {{ $slot }}
    </div>
</div>
