@props(['component', 'tableName'])
@php($tableId = $component->getTableAttributes()['id'])
<div wire:key="{{ $tableName }}-wrapper" x-data="tableWrapper($wire, '{{ $component->showBulkActionsDropdownAlpine() }}', '{{ $tableId }}', '{{ $component->getPrimaryKey() }}')">
    <div {{ $attributes->merge($this->getComponentWrapperAttributes()) }}
        @if ($component->hasRefresh()) wire:poll{{ $component->getRefreshOptions() }} @endif
        @if ($component->isFilterLayoutSlideDown()) wire:ignore.self @endif>

        <div>
        @if ($component->debugIsEnabled())
            @include('livewire-tables::includes.debug')
        @endif
        @if ($component->offlineIndicatorIsEnabled())
            @include('livewire-tables::includes.offline')
        @endif

            {{ $slot }}
        </div>
    </div>
</div>
