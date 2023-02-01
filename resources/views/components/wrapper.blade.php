@props(['component'])

@php
    $refresh = $this->getRefreshStatus();
    $theme = $component->getTheme();
@endphp

@if ($component->hasConfigurableAreaFor('before-tools'))
    @include($component->getConfigurableAreaFor('before-tools'), $component->getParametersForConfigurableArea('before-tools'))
@endif

 <div
    {{ $attributes->merge($this->getComponentWrapperAttributes()) }}

    @if ($component->hasRefresh())
        wire:poll{{ $component->getRefreshOptions() }}
    @endif

    @if ($component->isFilterLayoutSlideDown())
        wire:ignore.self x-data="{ filtersOpen: $wire.filterSlideDownDefaultVisible }"
    @endif
>
     @include('livewire-tables::includes.debug')
     @include('livewire-tables::includes.offline')

     {{ $slot }}
</div>
