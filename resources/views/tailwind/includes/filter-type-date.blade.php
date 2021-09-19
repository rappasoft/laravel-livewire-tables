<div class="flex rounded-md shadow-sm mt-1">
    <input
        wire:model.stop="filters.{{ $key }}"
        wire:key="filter-{{ $key }}"
        id="filter-{{ $key }}"
        type="date"
        @if(isset($filter->options['min']) && strlen($filter->options['min'])) min="{{ $filter->options['min'] }}" @endif
        @if(isset($filter->options['max']) && strlen($filter->options['max'])) max="{{ $filter->options['max'] }}" @endif
        class="block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-800 dark:text-white dark:border-gray-600"
    />
</div>
