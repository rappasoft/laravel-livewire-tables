<div>
    @if ($showFilters && count($this->getFiltersWithoutSearch()))
    <div class="md:mb-4 px-6 py-2 md:p-0">
        <small class="text-gray-700 dark:text-white">@lang('Applied Filters'):</small>

        @foreach($filters as $key => $value)
        @if ($key !== 'search' && strlen($value))
        <span wire:key="filter-pill-{{ $key }}"
              class="inline-flex items-center px-2.5 py-0.5 capitalize rounded-full text-xs font-medium leading-4 {{ $this->customThemeColor ? "bg-{$this->customThemeColor}-100 text-{$this->customThemeColor}-800  dark:bg-{$this->customThemeColor}-200 dark:text-{$this->customThemeColor}-900" : 'bg-indigo-100 text-indigo-800 dark:bg-indigo-200 dark:text-indigo-900' }}">
            {{ $filterNames[$key] ?? collect($this->columns())->pluck('text', 'column')->get($key, ucwords(strtr($key, ['_' => ' ', '-' => ' ']))) }}:
            @if(isset($customFilters[$key]) && method_exists($customFilters[$key], 'options'))
            {{ $customFilters[$key]->options()[$value] ?? $value }}
            @else
            {{ ucwords(strtr($value, ['_' => ' ', '-' => ' '])) }}
            @endif

            <button wire:click="
              removeFilter('{{ $key }}')"
                    type="button"
                    class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center focus:outline-none {{ $this->customThemeColor ? "text-{$this->customThemeColor}-400 hover:bg-{$this->customThemeColor}-200 hover:text-{$this->customThemeColor}-500 focus:bg-{$this->customThemeColor}-500" : 'text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus:bg-indigo-500' }} focus:text-white">
                <span class="sr-only">@lang('Remove filter option')</span>
                <svg class="h-2 w-2"
                     stroke="currentColor"
                     fill="none"
                     viewBox="0 0 8 8">
                    <path stroke-linecap="round"
                          stroke-width="1.5"
                          d="M1 1l6 6m0-6L1 7" />
                </svg>
            </button>
        </span>
        @endif
        @endforeach

        <button class="focus:outline-none active:outline-none"
                wire:click.prevent="resetFilters">
            <span
                  class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-200 dark:text-gray-900">
                @lang('Clear')
            </span>
        </button>
    </div>
    @endif
</div>
