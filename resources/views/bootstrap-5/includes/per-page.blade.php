@if ($paginationEnabled && $showPerPage)
    <div class="ms-0 ms-md-3">
        <select
            wire:model="perPage"
            id="perPage"
            class="form-select"
        >
            @foreach ($perPageAccepted as $item)
                <option value="{{ $item }}">{{ $item }}</option>
            @endforeach
        </select>
    </div>
@endif
