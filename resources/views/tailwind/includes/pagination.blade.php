@if ($showPagination)
    <div class="px-6 py-2 sm:p-0">
        @if ($paginationEnabled && $rows->lastPage() > 1)
            <div class="flex flex-col-reverse sm:flex-row">
                @include('livewire-tables::tailwind.includes.per-page')
                <div class="flex-1">
                {{ $rows->onEachSide(1)->links()  }}
                </div>
            </div>
        @else
            <p class="text-sm text-gray-700 leading-5 dark:text-white">
                @lang('Showing')
                <span class="font-medium">{{ $rows->count() }}</span>
                @lang('results')
            </p>
        @endif
    </div>
@endif
