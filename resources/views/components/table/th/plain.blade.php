@aware(['component'])

<th scope="col"
    @class([
        'table-cell px-3 py-2 md:px-6 md:py-3 text-center md:text-left bg-gray-50 dark:bg-gray-800' => $component->isTailwind(),
        '' => ($component->isBootstrap())
    ])
>
    {{ $slot }}
</th>
