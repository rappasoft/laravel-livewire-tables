@aware(['component'])
@props(['filter'])
@php
    $theme = $component->getTheme();
@endphp
<label for="{{ $component->getTableName() }}-filter-{{ $filter->getKey() }}" 
    @class([
        'block text-sm font-medium leading-5 text-gray-700 dark:text-white' => $theme === 'tailwind',
        'd-block' => $theme === 'bootstrap-4',
        'mb-2' => $theme === 'bootstrap-5',
    ])
>
    {{ $filter->getName() }}
</label>
