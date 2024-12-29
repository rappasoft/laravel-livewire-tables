@aware([ 'rowIndex', 'rowID','isTailwind','isBootstrap'])
@props(['column' => null, 'customAttributes' => [], 'displayMinimisedOnReorder' => false, 'hideUntilReorder' => false])


<td x-cloak {{ $attributes
    ->merge($customAttributes)
    ->class(['px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white' => $isTailwind && ($customAttributes['default'] ?? true)])
    ->class(['hidden' => $isTailwind && $column && $column->shouldCollapseAlways()])
    ->class(['hidden md:table-cell' => $isTailwind && $column && $column->shouldCollapseOnMobile()])
    ->class(['hidden lg:table-cell' => $isTailwind && $column && $column->shouldCollapseOnTablet()])
    ->class(['d-none' => $isBootstrap && $column && $column->shouldCollapseAlways()])
    ->class(['d-none d-md-table-cell' => $isBootstrap && $column && $column->shouldCollapseOnMobile()])
    ->class(['d-none d-lg-table-cell' => $isBootstrap && $column && $column->shouldCollapseOnTablet()])
    ->except(['default','default-styling','default-colors'])
}} @if($hideUntilReorder) x-show="reorderDisplayColumn" @endif >
    {{ $slot }}
</td>
