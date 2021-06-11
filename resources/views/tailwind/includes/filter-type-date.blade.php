<div class="flex rounded-md shadow-sm mt-1">
    <input
        wire:model.stop="filters.{{ $key }}"
        wire:key="filter-{{ $key }}"
        id="filter-{{ $key }}"
        type="date"
        @if(isset($filter->options['min']) && strlen($filter->options['min'])) min="{{ $filter->options['min'] }}" @endif
        @if(isset($filter->options['max']) && strlen($filter->options['max'])) max="{{ $filter->options['max'] }}" @endif
        class="flex-1 shadow-sm border-gray-300 block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:outline-none focus:border-indigo-300 focus:shadow-outline-indigo @if (isset($filters[$key]) && strlen($filters[$key])) rounded-none rounded-l-md @else rounded-md @endif"
    />
</div>
