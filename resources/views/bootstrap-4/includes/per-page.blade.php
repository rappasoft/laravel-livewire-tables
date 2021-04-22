@if ($paginationEnabled && $showPerPage)
    <div class="ml-0 ml-md-3">
        <select
            wire:model="perPage"
            id="perPage"
            class="form-control"
        >
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select>
    </div>
@endif
