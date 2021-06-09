@if ($filtersView || count($customFilters))
    <div class="btn-group d-block d-md-inline">
        <button type="button" class="btn dropdown-toggle d-block w-100 d-md-inline" data-bs-toggle="dropdown">
            @lang('Filters')

            @if (count($this->getFiltersWithoutSearch()))
                <span class="badge bg-info">
                   {{ count($this->getFiltersWithoutSearch()) }}
                </span>
            @endif

            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu w-100" role="menu">
            <li>
                @if ($filtersView)
                    @include($filtersView)
                @elseif (count($customFilters))
                    @foreach ($customFilters as $key => $filter)
                        <div wire:key="filter-{{ $key }}" class="p-2">
                            <label for="filter-{{ $key }}" class="mb-2">
                                {{ $filter->name() }}
                            </label>

                            @if ($filter->isSelect())
                                @include('livewire-tables::bootstrap-5.includes.filter-type-select')
                            @elseif($filter->isDate())
                                @include('livewire-tables::bootstrap-5.includes.filter-type-date')
                            @endif
                        </div>
                    @endforeach
                @endif

                @if (count($this->getFiltersWithoutSearch()))
                    <div class="dropdown-divider"></div>

                    <a
                        href="#"
                        wire:click.prevent="resetFilters"
                        class="dropdown-item"
                    >
                        @lang('Clear')
                    </a>
                @endif
            </li>
        </ul>
    </div>
@endif
