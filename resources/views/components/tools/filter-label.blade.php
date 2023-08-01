@aware(['component', 'tableName'])
@props(['filter', 'filterLayout' => 'popover', 'tableName' => 'table'])

<label for="{{ $tableName }}-filter-{{ $filter->getKey() }}"
    @class([
        'block text-sm font-medium leading-5 text-gray-700 dark:text-white' => $component->isTailwind(),
        'd-block' => $component->isBootstrap() && $filterLayout == 'slide-down',
        'mb-2' => $component->isBootstrap() && $filterLayout == 'popover',
    ])
>
    {{ $filter->getName() }}
</label>
