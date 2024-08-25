<div {{ $attributes
            ->merge($this->getActionWrapperAttributes)
            ->class(['flex flex-cols py-2 space-x-2' => $this->isTailwind && $this->getActionWrapperAttributes['default-styling'] ?? true])
            ->class(['' => $this->isTailwind && $this->getActionWrapperAttributes['default-colors'] ?? true])
            ->class(['d-flex flex-cols py-2 space-x-2' => $this->isBootstrap && $this->getActionWrapperAttributes['default-styling'] ?? true])
            ->class(['' => $this->isBootstrap && $this->getActionWrapperAttributes['default-colors'] ?? true])
            ->class([$this->getActionsPosition => true])
            ->except(['default-styling','default-colors'])
        }} >
    @foreach($this->getActions as $action)
        {{ $action->render() }}
    @endforeach
</div>