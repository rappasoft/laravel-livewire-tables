@php
    $theme = $component->getTheme();
@endphp

@if ($theme === 'tailwind')
    <div class="rounded-md shadow-sm">
        <select multiple
            wire:model.stop="{{ $component->getTableName() }}.filters.{{ $filter->getKey() }}"
            wire:key="{{ $component->getTableName() }}-filter-{{ $filter->getKey() }}"
            id="{{ $component->getTableName() }}-filter-{{ $filter->getKey() }}"
            class="block w-full transition duration-150 ease-in-out border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-800 dark:text-white dark:border-gray-600"
        >
        @if ($filter->getFirstOption() != "")
             <option @if($filter->isEmpty($this)) selected @endif value="all">{{ $filter->getFirstOption()}}</option>
        @endif
            @foreach($filter->getOptions() as $key => $value)
                @if (is_iterable($value))
                    <optgroup label="{{ $key }}">
                        @foreach ($value as $optionKey => $optionValue)
                            <option value="{{ $optionKey }}">{{ $optionValue }}</option>
                        @endforeach
                    </optgroup>
                @else
                    <option value="{{ $key }}">{{ $value }}</option>
                @endif
            @endforeach
        </select>
    </div>
@elseif ($theme === 'bootstrap-4' || $theme === 'bootstrap-5')
    <select multiple
        wire:model.stop="{{ $component->getTableName() }}.filters.{{ $filter->getKey() }}"
        wire:key="{{ $component->getTableName() }}-filter-{{ $filter->getKey() }}"
        id="{{ $component->getTableName() }}-filter-{{ $filter->getKey() }}"
        class="{{ $theme === 'bootstrap-4' ? 'form-control' : 'form-select' }}"
    >
    @if ($filter->getFirstOption() != "")
        <option @if($filter->isEmpty($this)) selected @endif value="all">{{ $filter->getFirstOption()}}</option>
    @endif
        @foreach($filter->getOptions() as $key => $value)
            @if (is_iterable($value))
                <optgroup label="{{ $key }}">
                    @foreach ($value as $optionKey => $optionValue)
                        <option value="{{ $optionKey }}">{{ $optionValue }}</option>
                    @endforeach
                </optgroup>
            @else
                <option value="{{ $key }}">{{ $value }}</option>
            @endif
        @endforeach
    </select>
@endif
