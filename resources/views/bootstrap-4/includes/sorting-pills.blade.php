@if ($showSorting && count($sorts))
    <div wire:key="sort-badges" class="mb-3">
        <small class="text-secondary">@lang('Applied Sorting'):</small>

        @foreach($sorts as $col => $dir)
            <span
                wire:key="sort-{{ $col }}"
                class="badge badge-pill badge-info d-inline-flex align-items-center"
            >
                <span>{{ $sortNames[$col] ?? ucwords(strtr($col, ['_' => ' ', '-' => ' '])) }}: {{ $dir === 'asc' ? 'A-Z' : 'Z-A' }}</span>

                <a
                    href="#"
                    wire:click.prevent="removeSort('{{ $col }}')"
                    class="text-white ml-2"
                >
                    <span class="sr-only">@lang('Remove sort option')</span>
                    <svg style="width:.5em;height:.5em" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                        <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
                    </svg>
                </a>
            </span>
        @endforeach

        <a
            href="#"
            wire:click.prevent="resetSorts"
            class="badge badge-pill badge-light"
        >
            @lang('Clear')
        </a>
    </div>
@endif
