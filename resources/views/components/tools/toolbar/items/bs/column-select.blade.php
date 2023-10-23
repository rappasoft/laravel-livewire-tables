@aware(['component', 'tableName'])
<div
                @class([
                    'd-none d-sm mb-3 mb-md-0 pl-0 pl-md-2' => $component->getColumnSelectIsHiddenOnMobile() && $component->isBootstrap4(),
                    'd-none d-md-block mb-3 mb-md-0 pl-0 pl-md-2' => $component->getColumnSelectIsHiddenOnTablet() && $component->isBootstrap4(),
                    'd-none d-sm-block mb-3 mb-md-0 md-0 ms-md-2' => $component->getColumnSelectIsHiddenOnMobile() && $component->isBootstrap5(),
                    'd-none d-md-block mb-3 mb-md-0 md-0 ms-md-2' => $component->getColumnSelectIsHiddenOnTablet() && $component->isBootstrap5(),
                ])
            >
                <div
                    x-data="{ open: false, childElementOpen: false }"
                    x-on:keydown.escape.stop="if (!childElementOpen) { open = false }"
                    x-on:mousedown.away="if (!childElementOpen) { open = false }"
                    @class([
                        'dropdown d-block d-md-inline' => $component->isBootstrap(),
                    ])
                    wire:key="{{ $tableName }}-column-select-button"
                >
                    <button
                        x-on:click="open = !open"
                        @class([
                            'btn dropdown-toggle d-block w-100 d-md-inline' => $component->isBootstrap(),
                        ])
                        type="button" id="{{ $tableName }}-columnSelect" aria-haspopup="true"
                        x-bind:aria-expanded="open"
                    >
                        @lang('Columns')
                    </button>

                    <div
                        x-bind:class="{ 'show': open }"
                        @class([
                            'dropdown-menu dropdown-menu-right w-100 mt-0 mt-md-3' => $component->isBootstrap4(),
                            'dropdown-menu dropdown-menu-end w-100' => $component->isBootstrap5(),
                        ])
                        aria-labelledby="columnSelect-{{ $tableName }}"
                    >
                        @if($component->isBootstrap4())
                            <div wire:key="{{ $tableName }}-columnSelect-selectAll-{{ rand(0,1000) }}">
                                <label wire:loading.attr="disabled" class="px-2 mb-1">
                                    <input
                                        wire:loading.attr="disabled"
                                        type="checkbox"
                                        @if($component->getSelectableSelectedColumns()->count() == $component->getSelectableColumns()->count()) checked wire:click="deselectAllColumns" @else unchecked wire:click="selectAllColumns" @endif
                                    />

                                    <span class="ml-2">{{ __('All Columns') }}</span>
                                </label>
                            </div>
                        @elseif($component->isBootstrap5())
                            <div class="form-check ms-2" wire:key="{{ $tableName }}-columnSelect-selectAll-{{ rand(0,1000) }}">
                                <input
                                    wire:loading.attr="disabled"
                                    type="checkbox"
                                    class="form-check-input"
                                    @if($component->getSelectableSelectedColumns()->count() == $component->getSelectableColumns()->count()) checked wire:click="deselectAllColumns" @else unchecked wire:click="selectAllColumns" @endif
                                />

                                <label wire:loading.attr="disabled" class="form-check-label">
                                    {{ __('All Columns') }}
                                </label>
                            </div>
                        @endif

                        @foreach ($component->getColumnsForColumnSelect() as $columnSlug => $columnTitle)
                                <div
                                    wire:key="{{ $tableName }}-columnSelect-{{ $loop->index }}"
                                    @class([
                                        'form-check ms-2' => $component->isBootstrap5(),
                                    ])
                                >
                                    @if ($component->isBootstrap4())
                                        <label
                                            wire:loading.attr="disabled"
                                            wire:target="selectedColumns"
                                            class="px-2 {{ $loop->last ? 'mb-0' : 'mb-1' }}"
                                        >
                                            <input
                                                wire:model.live="selectedColumns"
                                                wire:target="selectedColumns"
                                                wire:loading.attr="disabled" type="checkbox"
                                                value="{{ $columnSlug }}"
                                            />
                                            <span class="ml-2">
                                                {{ $columnTitle }}
                                            </span>
                                        </label>
                                    @elseif($component->isBootstrap5())
                                        <input
                                            wire:model.live="selectedColumns"
                                            wire:target="selectedColumns"
                                            wire:loading.attr="disabled"
                                            type="checkbox"
                                            class="form-check-input"
                                            value="{{ $columnSlug }}"
                                        />
                                        <label
                                            wire:loading.attr="disabled"
                                            wire:target="selectedColumns"
                                            class="{{ $loop->last ? 'mb-0' : 'mb-1' }} form-check-label"
                                        >
                                            {{ $columnTitle }}
                                        </label>
                                    @endif
                                </div>
                        @endforeach
                    </div>
                </div>
            </div>
