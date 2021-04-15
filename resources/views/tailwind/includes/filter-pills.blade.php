@if ($showFilters && count(array_filter($filters)) && !(count(array_filter($filters)) === 1 && isset($filters['search'])))
    <div wire:key="filter-badges" class="p-6 md:p-0">
        <small class="text-gray-700">@lang('Applied Filters'):</small>

        @foreach($filters as $key => $value)
            @if ($key !== 'search' && strlen($value))
                <span
                    wire:key="filter-{{ $key }}"
                    class="inline-flex items-center py-0.5 pl-2 pr-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-700"
                >
                        {{ $filterNames[$key] ?? ucwords(strtr($key, ['_' => ' ', '-' => ' '])) }}: {{ ucwords(strtr($value, ['_' => ' ', '-' => ' '])) }}

                        <button
                            wire:click="removeFilter('{{ $key }}')"
                            type="button"
                            class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-primary-400 hover:bg-primary-200 hover:text-primary-500 focus:outline-none focus:bg-primary-500 focus:text-white"
                        >
                            <span class="sr-only">@lang('Remove sort option')</span>
                            <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                                <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
                            </svg>
                        </button>
                    </span>
            @endif
        @endforeach

        <button class="focus:outline-none active:outline-none" wire:click.prevent="resetFilters">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                    @lang('Clear')
                </span>
        </button>
    </div>
@endif
