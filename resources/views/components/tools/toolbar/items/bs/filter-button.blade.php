@aware(['component', 'tableName'])
<div x-show="!currentlyReorderingStatus"
                @class([
                    'ml-0 ml-md-2 mb-3 mb-md-0' => $component->isBootstrap4(),
                    'ms-0 ms-md-2 mb-3 mb-md-0' => $component->isBootstrap5() && $component->searchIsEnabled(),
                    'mb-3 mb-md-0' => $component->isBootstrap5() && !$component->searchIsEnabled(),
                ])
            >
                <div
                    @if ($component->isFilterLayoutPopover())
                        x-data="{ open: false, childElementOpen: false  }"
                        x-on:keydown.escape.stop="if (!childElementOpen) { open = false }"
                        x-on:mousedown.away="if (!childElementOpen) { open = false }"
                    @endif
                    @class([
                        'btn-group d-block d-md-inline' => $component->isBootstrap(),
                    ])
                >
                    <div>
                        <button
                            type="button"
                            @class([
                                'btn dropdown-toggle d-block w-100 d-md-inline' => $component->isBootstrap(),
                            ])
                            @if ($component->isFilterLayoutPopover()) x-on:click="open = !open"
                                aria-haspopup="true"
                                x-bind:aria-expanded="open"
                                aria-expanded="true"
                            @endif
                            @if ($component->isFilterLayoutSlideDown()) x-on:click="filtersOpen = !filtersOpen" @endif
                        >
                            @lang('Filters')

                            @if ($count = $component->getFilterBadgeCount())
                                <span @class([
                                        'badge badge-info' => $component->isBootstrap(),
                                    ])>
                                    {{ $count }}
                                </span>
                            @endif

                            <span @class([
                                'caret' => $component->isBootstrap(),
                            ])></span>
                        </button>
                    </div>

                    @if ($component->isFilterLayoutPopover())
                    <x-livewire-tables::tools.toolbar.items.bs.filter-popover />

                    @endif
                </div>
            </div>
