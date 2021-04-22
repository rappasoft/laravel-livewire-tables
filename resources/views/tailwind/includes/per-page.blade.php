@if ($paginationEnabled && $showPerPage)
    <div class="w-full md:w-auto">
        <select
            wire:model="perPage"
            id="perPage"
            class="rounded-md shadow-sm block w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:border-indigo-300 focus:shadow-outline-indigo sm:text-sm sm:leading-5"
        >
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select>
    </div>
@endif
