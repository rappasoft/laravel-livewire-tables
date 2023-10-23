@aware(['component', 'tableName'])
<ul
                            x-cloak
                            @class([
                                'dropdown-menu w-100 mt-md-5' => $component->isBootstrap4(),
                                'dropdown-menu w-100' => $component->isBootstrap5(),
                            ])
                            x-bind:class="{ 'show': open }"
                            role="menu"
                        >
                            @foreach ($component->getVisibleFilters() as $filter)
                                <div
                                    wire:key="{{ $tableName }}-filter-{{ $filter->getKey() }}-toolbar"
                                    @class([
                                        'p-2' => $component->isBootstrap(),
                                    ])
                                    id="{{ $tableName }}-filter-{{ $filter->getKey() }}-wrapper"
                                >
                                    {{ $filter->render($component->filterLayout, $tableName, $component->isTailwind(), $component->isBootstrap4(), $component->isBootstrap5()) }}
                                </div>
                            @endforeach

                            @if ($component->hasAppliedVisibleFiltersWithValuesThatCanBeCleared())
                                <div
                                    @class([
                                        'dropdown-divider' => $component->isBootstrap(),
                                    ])
                                ></div>

                                <button
                                    wire:click.prevent="setFilterDefaults" x-on:click="open = false"
                                    @class([
                                        'dropdown-item btn text-center' => $component->isBootstrap4(),
                                        'dropdown-item text-center' => $component->isBootstrap5(),
                                    ])
                                >
                                    @lang('Clear')
                                </button>
                            @endif
                        </ul>