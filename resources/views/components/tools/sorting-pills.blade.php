@aware([ 'tableName','isTailwind','isBootstrap','isBootstrap4','isBootstrap5'])

@if ($this->isTailwind)
    <div>
        @if ($this->sortingPillsAreEnabled() && $this->hasSorts())
            <div class="mb-4 px-4 md:p-0" x-cloak x-show="!currentlyReorderingStatus">
                <small class="text-gray-700 dark:text-white">{{ __($this->getLocalisationPath.'Applied Sorting') }}:</small>

                @foreach($this->getSorts() as $columnSelectName => $direction)
                    @php($column = $this->getColumnBySelectName($columnSelectName) ?? $this->getColumnBySlug($columnSelectName))

                    @continue(is_null($column))
                    @continue($column->isHidden())
                    @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))

                    <span
                        wire:key="{{ $tableName }}-sorting-pill-{{ $columnSelectName }}"
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-indigo-100 text-indigo-800 capitalize dark:bg-indigo-200 dark:text-indigo-900"
                    >
                        {{ $column->getSortingPillTitle() }}: {{ $column->getSortingPillDirectionLabel($direction, $this->getDefaultSortingLabelAsc, $this->getDefaultSortingLabelDesc) }}

                        <button
                            wire:click="clearSort('{{ $columnSelectName }}')"
                            type="button"
                            class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus:outline-none focus:bg-indigo-500 focus:text-white"
                        >
                            <span class="sr-only">{{ __($this->getLocalisationPath.'Remove sort option') }}</span>
                            <x-heroicon-m-x-mark class="h-3 w-3" />
                        </button>
                    </span>
                @endforeach

                <button
                    wire:click.prevent="clearSorts"
                    class="focus:outline-none active:outline-none"
                >
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-200 dark:text-gray-900">
                        {{ __($this->getLocalisationPath.'Clear') }}
                    </span>
                </button>
            </div>
        @endif
    </div>
@elseif ($this->isBootstrap4)
    <div>
        @if ($this->sortingPillsAreEnabled() && $this->hasSorts())
            <div class="mb-3" x-cloak x-show="!currentlyReorderingStatus">
                <small>{{ __($this->getLocalisationPath.'Applied Sorting') }}:</small>

                @foreach($this->getSorts() as $columnSelectName => $direction)
                    @php($column = $this->getColumnBySelectName($columnSelectName) ?? $this->getColumnBySlug($columnSelectName))

                    @continue(is_null($column))
                    @continue($column->isHidden())
                    @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))

                    <span
                        wire:key="{{ $tableName . '-sorting-pill-' . $columnSelectName }}"
                        class="badge badge-pill badge-info d-inline-flex align-items-center"
                    >
                        {{ $column->getSortingPillTitle() }}: {{ $column->getSortingPillDirectionLabel($direction, $this->getDefaultSortingLabelAsc, $this->getDefaultSortingLabelDesc) }}

                        <a
                            href="#"
                            wire:click="clearSort('{{ $columnSelectName }}')"
                            class="text-white ml-2"
                        >
                            <span class="sr-only">{{ __($this->getLocalisationPath.'Remove sort option') }}</span>
                            <x-heroicon-m-x-mark class="laravel-livewire-tables-btn-smaller" />
                        </a>
                    </span>
                @endforeach

                <a
                    href="#"
                    wire:click.prevent="clearSorts"
                    class="badge badge-pill badge-light"
                >
                    {{ __($this->getLocalisationPath.'Clear') }}
                </a>
            </div>
        @endif
    </div>
@elseif ($this->isBootstrap5)
    <div>
        @if ($this->sortingPillsAreEnabled() && $this->hasSorts())
            <div class="mb-3" x-cloak x-show="!currentlyReorderingStatus">
                <small>{{ __($this->getLocalisationPath.'Applied Sorting') }}:</small>

                @foreach($this->getSorts() as $columnSelectName => $direction)
                    @php($column = $this->getColumnBySelectName($columnSelectName) ?? $this->getColumnBySlug($columnSelectName))

                    @continue(is_null($column))
                    @continue($column->isHidden())
                    @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))

                    <span
                        wire:key="{{ $tableName }}-sorting-pill-{{ $columnSelectName }}"
                        class="badge rounded-pill bg-info d-inline-flex align-items-center"
                    >
                        {{ $column->getSortingPillTitle() }}: {{ $column->getSortingPillDirectionLabel($direction, $this->getDefaultSortingLabelAsc, $this->getDefaultSortingLabelDesc) }}

                        <a
                            href="#"
                            wire:click="clearSort('{{ $columnSelectName }}')"
                            class="text-white ms-2"
                        >
                            <span class="visually-hidden">{{ __($this->getLocalisationPath.'Remove sort option') }}</span>
                            <x-heroicon-m-x-mark class="laravel-livewire-tables-btn-smaller" />
                        </a>
                    </span>
                @endforeach

                <a
                    href="#"
                    wire:click.prevent="clearSorts"
                    class="badge rounded-pill bg-light text-dark text-decoration-none"
                >
                    {{ __($this->getLocalisationPath.'Clear') }}
                </a>
            </div>
        @endif
    </div>
@endif
