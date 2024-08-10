@aware(['component','isTailwind','isBootstrap'])

<div @class([
    'flex-col' => $isTailwind,
    'd-flex flex-column ' => ($isBootstrap),
])>
    {{ $slot }}
</div>
