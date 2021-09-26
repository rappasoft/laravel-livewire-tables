@if ($showPagination)
    <div class="px-6 py-2 md:p-0">
        @if ($paginationEnabled && $rows->lastPage() > 1)
            {{ $rows->links('livewire-tables::tailwind.includes.partials.pagination') }}
        @else
            <p class="text-sm text-gray-700 leading-5 dark:text-white">
                @lang('Showing')
                <span class="font-medium">{{ $rows->count() }}</span>
                @lang('results')
            </p>
        @endif
    </div>
@endif
