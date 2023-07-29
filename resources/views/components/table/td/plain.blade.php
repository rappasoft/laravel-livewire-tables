@aware(['component', 'rowIndex', 'rowID'])
@props(['column' => null, 'customAttributes' => []])

@if ($component->isTailwind())
    <td {{ $attributes
        ->merge($customAttributes)
        ->class(['px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white' => $customAttributes['default'] ?? true])
        ->class(['hidden sm:table-cell' => $column && $column->shouldCollapseOnMobile()])
        ->class(['hidden md:table-cell' => $column && $column->shouldCollapseOnTablet()])
        ->except('default')
    }}
    id='row-{{ $rowID }}-reorder'
    x-on:dragstart.self="
        dragging = true;
        event.dataTransfer.effectAllowed = 'move';
        event.dataTransfer.setData('text/plain', event.target.id);
    "
    x-data="{ dragging: false }"
    draggable="true"

    >{{ $slot }}</td>
@elseif ($component->isBootstrap())
    <td {{ $attributes
        ->merge($customAttributes)
        ->class(['' => $customAttributes['default'] ?? true])
        ->class(['d-none d-sm-table-cell' => $column && $column->shouldCollapseOnMobile()])
        ->class(['d-none d-md-table-cell' => $column && $column->shouldCollapseOnTablet()])
        ->except('default')
    }}
    id='row-{{ $rowID }}-reorder'
    x-on:dragstart.self="
        dragging = true;
        event.dataTransfer.effectAllowed = 'move';
        event.dataTransfer.setData('text/plain', event.target.id);
    "
    x-data="{ dragging: false }"
    draggable="true"
    >{{ $slot }}</td>
@endif
