@if ($paginationEnabled || $searchEnabled)
    <div class="row mb-4">
        @if ($paginationEnabled && $perPageEnabled)
            <div class="col form-inline">
                {{ $perPageLabel }}: &nbsp;

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
                <input
                    @if (is_numeric($searchDebounce)&&$searchType=='debounce') wire:model.debounce.{{ $searchDebounce }}ms="search" @endif
                    @if ($searchType=='lazy') wire:model.lazy="search" @endif
                    @if ($disableSearchOnLoading) wire:loading.attr="disabled" @endif
                    class="form-control"
                    type="text"
                    placeholder="{{ $searchLabel }}"
                />
            </div>
        @endif
    </div>
@endif
