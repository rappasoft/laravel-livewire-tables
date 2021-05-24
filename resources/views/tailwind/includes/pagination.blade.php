@if ($showPagination)
    <div class="p-6 md:p-0">
        @if ($paginationEnabled && $rows->lastPage() > 1)
            {{ $rows->links() }}
        @else
            <p class="text-sm text-gray-700 leading-5">
                @lang('Showing')
                <span class="font-medium">{{ $rows->count() }}</span>
                @lang('results')
            </p>
        @endif
    </div>
@endif
