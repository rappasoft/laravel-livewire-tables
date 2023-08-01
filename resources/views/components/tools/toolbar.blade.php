@aware(['component', 'tableName'])

@if ($component->hasConfigurableAreaFor('before-toolbar'))
    @include($component->getConfigurableAreaFor('before-toolbar'), $component->getParametersForConfigurableArea('before-toolbar'))
@endif

@if ($component->isTailwind())
    @include('livewire-tables::components.tools.toolbar.tailwind')
@elseif ($component->isBootstrap())
    @include('livewire-tables::components.tools.toolbar.bootstrap')
@endif

@if ($component->hasConfigurableAreaFor('after-toolbar'))
    <div x-show="!currentlyReorderingStatus" >
        @include($component->getConfigurableAreaFor('after-toolbar'), $component->getParametersForConfigurableArea('after-toolbar'))
    </div>
@endif
