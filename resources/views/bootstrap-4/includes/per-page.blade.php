@if ($paginationEnabled && $showPerPage)
    <div class="ml-0 ml-md-3">
        <select
            wire:model="perPage"
            id="perPage"
            class="form-control"
        >
            @foreach ($perPageAccepted as $item)
                <option value="{{ $item }}">{{ $item }}</option>
            @endforeach
        </select>
    </div>
@endif
