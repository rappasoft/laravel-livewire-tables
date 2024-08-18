<a {{ $attributes->merge($buttonAttributes)
            ->class(['focus:border-indigo-300 focus:ring-indigo-200  justify-center text-center items-center inline-flex rounded-md border shadow-sm px-4 py-2 text-sm font-medium focus:ring focus:ring-opacity-50' => $this->isTailwind && $buttonAttributes['default'] ?? true])
            ->class(['btn btn-sm btn-success' => $this->isBootstrap && $buttonAttributes['default'] ?? true])
            ->except('default')
        }} 
           @if($hasWireElement)
               wire:{{ $wireElementType }}="{{ $wireElementComponentName }} , {{ $wireElementParams }}"
           @endif
           @if($shouldWireNavigate)
            wire:navigate
           @endif
        >
            {{ $label }}

        @if($hasIcon)
            <i {{ $iconAttributes
                ->class(["ms-1 ". $icon => $this->isBootstrap])
                ->class(["ml-1 ". $icon => $this->isTailwind])
                ->except('default')
            }}></i>
        @endif
</a>