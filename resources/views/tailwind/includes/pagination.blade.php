<div class="p-6 md:p-0">
    @if ($paginationEnabled && $showPerPage && $rows->lastPage() > 1)
        {{ $rows->links() }}
    @else
        <p class="text-sm text-gray-700 leading-5">{!! __('Showing <span class="font-medium">:count</span> results', ['count' => $rows->count()]) !!}</p>
    @endif
</div>
