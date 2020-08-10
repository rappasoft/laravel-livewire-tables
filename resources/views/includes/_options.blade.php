@if ($paginationEnabled || $searchEnabled)
    <div class="row mb-4">
        @if ($paginationEnabled && $perPageEnabled)
            <div class="col form-inline">
                @lang('laravel-livewire-tables::strings.per_page'): &nbsp;

                <select wire:model="perPage" class="form-control">
                    @if (is_array($perPageOptions))
                        @foreach ($perPageOptions as $option)
                            <option>{{ $option }}</option>
                        @endforeach
                    @else
                        <option>10</option>
                        <option>15</option>
                        <option>25</option>
                    @endif
                </select>
            </div>
        @endif

        @if ($searchEnabled)
            <div class="col">
                @if ($clearSearchButton)
                    <div class="input-group">
                @endif
                    <input
                        @if (is_numeric($searchDebounce) && $searchUpdateMethod === 'debounce') wire:model.debounce.{{ $searchDebounce }}ms="search" @endif
                        @if ($searchUpdateMethod === 'lazy') wire:model.lazy="search" @endif
                        @if ($disableSearchOnLoading) wire:loading.attr="disabled" @endif
                        class="form-control"
                        type="text"
                        placeholder="{{ __('laravel-livewire-tables::strings.search') }}"
                    />
                @if ($clearSearchButton)
                        <div class="input-group-append">
                            <button class="{{ $clearSearchButtonClass }}" type="button" wire:click="clearSearch">@lang('laravel-livewire-tables::strings.clear')</button>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>
@endif
