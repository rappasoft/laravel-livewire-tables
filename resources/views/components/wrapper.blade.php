@props(['component', 'tableName', 'primaryKey', 'isTailwind', 'isBootstrap','isBootstrap4', 'isBootstrap5'])
<div wire:key="{{ $tableName }}-wrapper" >
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
