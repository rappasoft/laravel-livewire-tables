@if ($paginationEnabled && $showPerPage)
    <div class="ms-0 ms-md-2">
        <select
            wire:model="perPage"
            id="perPage"
            class="form-select"
        >
            @foreach ($perPageAccepted as $item)
                <option value="{{ $item }}">{{ $item === -1 ? __('All') : $item }}</option>
            @endforeach
        </select>
    </div>
@endif
