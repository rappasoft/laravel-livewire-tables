<div {{ $attributes
            ->merge($this->getActionWrapperAttributes)
            ->class(['flex flex-cols py-2 space-x-2' => $this->isTailwind && $this->getActionWrapperAttributes['default-styling'] ?? true])
            ->class(['' => $this->isTailwind && $this->getActionWrapperAttributes['default-colors'] ?? true])
            ->class(['d-flex flex-cols py-2 space-x-2' => $this->isBootstrap && $this->getActionWrapperAttributes['default-styling'] ?? true])
            ->class(['' => $this->isBootstrap && $this->getActionWrapperAttributes['default-colors'] ?? true])
            ->class(['justify-start' => $this->getActionsPosition === 'left'])
            ->class(['justify-center' => $this->getActionsPosition === 'center'])
            ->class(['justify-end' => $this->getActionsPosition === 'right'])
            ->class(['pl-2' => $this->showActionsInToolbar && $this->getActionsPosition === 'left'])
            ->class(['pr-2' => $this->showActionsInToolbar && $this->getActionsPosition === 'right'])
            ->except(['default','default-styling','default-colors'])
        }} >
    @foreach($this->getActions as $action)
        {{ $action->render() }}
    @endforeach
</div>
