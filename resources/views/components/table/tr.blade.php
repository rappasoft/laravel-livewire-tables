@aware(['component', 'theme'])
@props(['row', 'rowIndex'])

@php
    $attributes = $attributes->merge(['wire:key' => 'row-'.$rowIndex.'-'.$component->getId()]);
    $customAttributes = $this->getTrAttributes($row, $rowIndex);
@endphp

<tr
    wire:loading.class.delay="opacity-50 dark:bg-gray-900 dark:opacity-60"
    id="{{ 'row-'.$row->{$this->getPrimaryKey()} }}"
            x-on:drop="removing = false"
            x-on:drop.prevent="
                const id = event.dataTransfer.getData('text/plain');
                const target = event.target.closest('tr');
                const parent = event.target.closest('tr').parentNode;
                const element = document.getElementById(id).closest('tr');
                parent.insertBefore(element, target.nextSibling);
                var table = document.getElementById('my-id');
                for (var i = 0, row; row = table.rows[i]; i++) {
                    if(i % 2 === 0)
                    {
                        row.classList.remove('bg-white');
                        row.classList.add('bg-gray-50');
                    }
                    else
                    {
                        row.classList.remove('bg-gray-50');
                        row.classList.add('bg-white');
                    }
                }
            "
            x-on:dragover.prevent="removing = true"
            x-on:dragleave.prevent="removing = false"

    @class([
        'bg-white dark:bg-gray-700 dark:text-white' => ($theme === 'tailwind' &&
        ($customAttributes['default'] ?? true) && $rowIndex % 2 === 0),
        'bg-gray-50 dark:bg-gray-800 dark:text-white' => ($theme === 'tailwind' && ($customAttributes['default'] ?? true) && $rowIndex % 2 !== 0),
        'cursor-pointer' => ($theme === 'tailwind' && $component->hasTableRowUrl()),
        'bg-white ' => (($theme === 'bootstrap-4' || $theme === 'bootstrap-5') && $rowIndex % 2 === 0),
        'bg-secondary' => (($theme === 'bootstrap-4' || $theme === 'bootstrap-5') && $rowIndex % 2 !== 0),
    ])
>
    {{ $slot }}
</tr>
