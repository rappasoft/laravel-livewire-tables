@aware(['component', 'theme'])

<div @class([
        'flex-col' => $theme === 'tailwind',
        'd-flex flex-column ' => ($theme === 'bootstrap-4' || $theme === 'bootstrap-5'),
    ])
>
&nbsp
    {{ $slot }}
</div>
