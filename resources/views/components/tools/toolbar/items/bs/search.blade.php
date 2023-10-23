@aware(['component', 'tableName'])
<div
                x-show="!currentlyReorderingStatus"
                @class([
                    'mb-3 mb-md-0 input-group' => $component->isBootstrap(),
                ])
            >
                <input
                    wire:model{{ $component->getSearchOptions() }}="search"
                    placeholder="{{ $component->getSearchPlaceholder() }}"
                    type="text"
                    {{ 
                        $attributes->merge($component->getSearchFieldAttributes())
                        ->class(['form-control' => $component->getSearchFieldAttributes()['default'] ?? true])
                        ->except('default') 
                    }}
                >

                @if ($component->hasSearch())
                    <div @class([
                            'input-group-append' => $component->isBootstrap(),
                        ])>
                        <button
                            wire:click="clearSearch"
                            type="button"
                            @class([
                                'btn btn-outline-secondary' => $component->isBootstrap(),
                            ])
                        >
                            <x-heroicon-m-x-mark style="width:.75em;height:.75em" />
                        </button>
                    </div>
                @endif
            </div>
