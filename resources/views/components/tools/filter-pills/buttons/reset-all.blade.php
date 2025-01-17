@aware(['isTailwind','isBootstrap','isBootstrap4','isBootstrap5'])
@if ($isTailwind)
    <button
        wire:click.prevent="setFilterDefaults"
        @class([
            'focus:outline-none active:outline-none'
        ])>
        <span
            {{
                $attributes->merge($this->getFilterPillsResetAllButtonAttributes())
                ->class([
                    'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium' => $this->getFilterPillsResetAllButtonAttributes()['default-styling'],
                    'bg-gray-100 text-gray-800 dark:bg-gray-200 dark:text-gray-900' => $this->getFilterPillsResetAllButtonAttributes()['default-colors'],
                ])
                ->except(['default-styling', 'default-colors'])
            }}
        >
            {{ __($this->getLocalisationPath.'Clear') }}
        </span>
    </button>
@else
    <a
        href="#"
        wire:click.prevent="setFilterDefaults"
        {{
            $attributes->merge($this->getFilterPillsResetAllButtonAttributes())
            ->class([
                'badge badge-pill badge-light' => $isBootstrap4 && $this->getFilterPillsResetAllButtonAttributes()['default-styling'],
                'badge rounded-pill bg-light text-dark text-decoration-none' => $isBootstrap5 && $this->getFilterPillsResetAllButtonAttributes()['default-styling'],
            ])
            ->except(['default-styling', 'default-colors'])
        }}
    >
        {{ __($this->getLocalisationPath.'Clear') }}
    </a>
@endif
