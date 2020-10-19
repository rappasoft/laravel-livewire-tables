@if ($filterEnabled && count($filtersViews))
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="12" height="12"><path fill="none" d="M0 0H24V24H0z"/><path d="M21 4v2h-1l-5 7.5V22H9v-8.5L4 6H3V4h18zM6.404 6L11 12.894V20h2v-7.106L17.596 6H6.404z"/></svg>
            </span>
            Filters {{ count($filters) ? '(' . count($filters) . ')' : '' }}
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <form id="filter-form">
                @foreach ($filtersViews as $view)
                    <div class="text-xs font-semibold uppercase text-left px-4 py-2">
                        {{ $view->getTitle() }}
                    </div>
                    <div class="px-4 mb-2">
                        @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.filters.'.$view->view, ['view' => $view])
                    </div>
                @endforeach

                @if ($clearFilterButton && count($filters) > 0)
                    <div class="px-4 py-2 bg-gray-100 text-right flex justify-end">
                        <button type="button" wire:click="clearFilters" onclick="document.querySelector('#filter-form').reset()" class="btn btn-link">
                            <span class="mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0H24V24H0z"/><path d="M6.929.515L21.07 14.657l-1.414 1.414-3.823-3.822L15 13.5V22H9v-8.5L4 6H3V4h4.585l-2.07-2.071L6.929.515zM9.585 6H6.404L11 12.894V20h2v-7.106l1.392-2.087L9.585 6zM21 4v2h-1l-1.915 2.872-1.442-1.443L17.596 6h-2.383l-2-2H21z"/></svg>
                            </span>
                            Clear filters
                        </button>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endif
