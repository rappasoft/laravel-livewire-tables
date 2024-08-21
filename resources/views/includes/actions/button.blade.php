<a {{ $attributes->merge()
            ->class(['justify-center text-center items-center inline-flex rounded-md border shadow-sm px-4 py-2 text-sm font-medium focus:ring focus:ring-opacity-50' => $this->isTailwind && $attributes['default-styling'] ?? true])
            ->class(['focus:border-indigo-300 focus:ring-indigo-200' => $this->isTailwind && $attributes['default-colors'] ?? true])
            ->class(['btn btn-sm btn-success' => $this->isBootstrap && $attributes['default-styling'] ?? true])
            ->class(['' => $this->isBootstrap && $attributes['default-colors'] ?? true])
            ->except(['default-styling', 'default-colors'])
        }} 
           @if($action->hasWireAction())
            {{ $action->getWireAction() }}="{{ $action->getWireActionParams() }}"
           @endif
           @if($action->getWireNavigateEnabled())
            wire:navigate
           @endif
        >
            {{ $action->getLabel() }}

        @if($action->hasIcon())
            <i {{ $action->getIconAttributes()
                ->class(["ms-1 ". $action->getIcon() => $this->isBootstrap])
                ->class(["ml-1 ". $action->getIcon() => $this->isTailwind])
                ->except('default-styling')
            }}></i>
        @endif
</a>