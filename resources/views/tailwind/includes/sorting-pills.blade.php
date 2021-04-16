@if ($showSorting && count($sorts))
    <div wire:key="sort-badges" class="p-6 md:p-0">
        <small class="text-gray-700">@lang('Applied Sorting'):</small>

        @foreach($sorts as $col => $dir)
            <span
                wire:key="sort-{{ $col }}"
                class="inline-flex items-center py-0.5 pl-2 pr-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-700"
            >
                {{ $sortNames[$col] ?? ucwords(strtr($col, ['_' => ' ', '-' => ' '])) }}: {{ $dir === 'asc' ? 'A-Z' : 'Z-A' }}

                <button
                    wire:click="removeSort('{{ $col }}')"
                    type="button"
                    class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-primary-400 hover:bg-primary-200 hover:text-primary-500 focus:outline-none focus:bg-primary-500 focus:text-white"
                >
                    <span class="sr-only">@lang('Remove sort option')</span>
                    <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                        <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
                    </svg>
                </button>
            </span>
        @endforeach

        <button
            wire:click.prevent="resetSorts"
            class="focus:outline-none active:outline-none"
        >
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                @lang('Clear')
            </span>
        </button>
    </div>
@endif
