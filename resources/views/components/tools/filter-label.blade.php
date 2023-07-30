@aware(['component'])
@props(['filter', 'filterLayout' => 'popover', 'tableName' => 'table'])

<label for="{{ $tableName }}-filter-{{ $filter->getKey() }}"
    @class([
        'block text-sm font-medium leading-5 text-gray-700 dark:text-white' => $component->isTailwind(),
        'd-block' => $component->isBootstrap4() && $filterLayout == 'slide-down',
        'mb-2' => $component->isBootstrap4() && $filterLayout == 'popover',
        'd-block' => $component->isBootstrap5() && $filterLayout == 'slide-down',
        'mb-2' => $component->isBootstrap5() && $filterLayout == 'popover',
    ])
>
    {{ $filter->getName() }}
</label>
