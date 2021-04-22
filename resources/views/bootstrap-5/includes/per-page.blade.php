@if ($paginationEnabled && $showPerPage)
    <div class="ms-0 ms-md-3">
        <select
            wire:model="perPage"
            id="perPage"
            class="form-select"
        >
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select>
    </div>
@endif
