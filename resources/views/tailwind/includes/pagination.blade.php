@if ($showPagination)
    <div class="p-6 md:p-0">
        @if ($paginationEnabled && $rows->lastPage() > 1)
            <p class="text-sm text-gray-700 leading-5">
                <span>@lang('Showing')</span>
                <span class="font-medium">{{ $rows->firstItem() }}</span>
                <span>@lang('to')</span>
                <span class="font-medium">{{ $rows->lastItem() }}</span>
                <span>@lang('of')</span>
                <span class="font-medium">{{ $rows->total() }}</span>
                <span>@choice('results', $rows->total())</span>
            </p>
        @else
            <p class="text-sm text-gray-700 leading-5">
                @lang('Showing')
                <span class="font-medium">{{ $rows->count() }}</span>
                @choice('results', $rows->count())
            </p>
        @endif
    </div>
@endif
