<div class="mt-1 relative rounded-md shadow-sm">
    <select
        wire:model.stop="filters.{{ $key }}"
        wire:key="filter-{{ $key }}"
        id="filter-{{ $key }}"
        class="block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out focus:border-{{ $this->themeColor }}-300 focus:ring focus:ring-{{ $this->themeColor }}-200 focus:ring-opacity-50 dark:bg-gray-800 dark:text-white dark:border-gray-600"
    >
        @foreach($filter->options() as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>
</div>
