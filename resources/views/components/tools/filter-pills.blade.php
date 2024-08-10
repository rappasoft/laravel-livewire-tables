@aware(['component', 'tableName','isTailwind','isBootstrap','isBootstrap4','isBootstrap5'])

@if ($component->filtersAreEnabled() && $component->filterPillsAreEnabled() && $component->hasAppliedVisibleFiltersForPills())
    <div>
        <div @class([
            'mb-4 px-4 md:p-0' => $isTailwind,
            'mb-3' => $isBootstrap,
        ]) x-cloak x-show="!currentlyReorderingStatus">
            <small @class([
                'text-gray-700 dark:text-white' => $isTailwind,
                '' =>  $isBootstrap,
            ])>
                @lang('Applied Filters'):
            </small>

            @foreach($component->getAppliedFiltersWithValues() as $filterSelectName => $value)
                @php($filter = $component->getFilterByKey($filterSelectName))

                @continue(is_null($filter))
                @continue($filter->isHiddenFromPills())

                @if ($filter->hasCustomPillBlade())
                    @include($filter->getCustomPillBlade(), ['filter' => $filter])
                @else
                    <span
                        wire:key="{{ $tableName }}-filter-pill-{{ $filter->getKey() }}"
                        @class([
                            'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-indigo-100 text-indigo-800 capitalize dark:bg-indigo-200 dark:text-indigo-900' => $isTailwind,
                            'badge badge-pill badge-info d-inline-flex align-items-center' => $isBootstrap4,
                            'badge rounded-pill bg-info d-inline-flex align-items-center' => $isBootstrap5,
                        ])
                    >
                        {{ $filter->getFilterPillTitle() }}: 
                        @php( $filterPillValue = $filter->getFilterPillValue($value))
                        @php( $separator = method_exists($filter, 'getPillsSeparator') ? $filter->getPillsSeparator() : ', ')

                        @if(is_array($filterPillValue) && !empty($filterPillValue))
                            @foreach($filterPillValue as $filterPillArrayValue)
                                {{ $filterPillArrayValue }}{!! $separator !!}
                            @endforeach
                        @else
                            {{ $filterPillValue }}
                        @endif

                        @if ($isTailwind)
                            <button
                                wire:click="resetFilter('{{ $filter->getKey() }}')"
                                type="button"
                                class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus:outline-none focus:bg-indigo-500 focus:text-white"
                            >
                                <span class="sr-only">@lang('Remove filter option')</span>
                                <x-heroicon-m-x-mark class="h-2 w-2" />
                            </button>
                        @else
                            <a
                                href="#"
                                wire:click="resetFilter('{{ $filter->getKey() }}')"
                                @class([
                                    'text-white ml-2' => ($isBootstrap),
                                ])
                            >
                                <span @class([
                                    'sr-only' => $isBootstrap4,
                                    'visually-hidden' => $isBootstrap5,
                                ])>
                                    @lang('Remove filter option')
                                </span>
                                <x-heroicon-m-x-mark class="laravel-livewire-tables-btn-tiny"  />
                            </a>
                        @endif
                    </span>
                @endif
            @endforeach

            @if ($isTailwind)
                <button
                    wire:click.prevent="setFilterDefaults"
                    class="focus:outline-none active:outline-none"
                >
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-200 dark:text-gray-900">
                        @lang('Clear')
                    </span>
                </button>
            @else
                <a
                    href="#"
                    wire:click.prevent="setFilterDefaults"
                    @class([
                        'badge badge-pill badge-light' => $isBootstrap4,
                        'badge rounded-pill bg-light text-dark text-decoration-none' => $isBootstrap5,
                    ])
                >
                    @lang('Clear')
                </a>
            @endif
        </div>
    </div>
@endif

