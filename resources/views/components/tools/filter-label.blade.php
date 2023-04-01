@aware(['component'])
@props(['filter','theme' => 'tailwind','filterLayout'])

<label for="{{ $component->getTableName() }}-filter-{{ $filter->getKey() }}" 
    @class([
        'block text-sm font-medium leading-5 text-gray-700 dark:text-white' => $theme === 'tailwind',
        'd-block' => $theme === 'bootstrap-4' && $component->isFilterLayoutSlideDown(),
        'mb-2' => $theme === 'bootstrap-4' && $component->isFilterLayoutPopover(),
        'd-block' => $theme === 'bootstrap-5' && $component->isFilterLayoutSlideDown(),
        'mb-2' => $theme === 'bootstrap-5' && $component->isFilterLayoutPopover(),
    ])
>
    {{ $filter->getName() }}
</label>
