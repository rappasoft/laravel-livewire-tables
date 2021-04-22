@if ($pagination ?? false || $showPerPage ?? false)
    <select
        wire:model="perPage"
        id="perPage"
        class="form-select"
    >
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
    </select>
@endif
