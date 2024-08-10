@aware(['component','isTailwind'])

<div @class([
    'flex-col' => $isTailwind,
    'd-flex flex-column ' => ($component->isBootstrap()),
])>
    {{ $slot }}
</div>
