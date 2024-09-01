<div @class([
    'flex-col' => $this->isTailwind,
    'd-flex flex-column ' => $this->isBootstrap,
])>
    {{ $slot }}
</div>
