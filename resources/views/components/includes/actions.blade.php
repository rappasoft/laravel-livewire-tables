<div {{ $attributes
            ->merge($this->getActionWrapperAttributes)
            ->class([
                'flex flex-cols py-2 space-x-2' => $this->isTailwind && ($this->getActionWrapperAttributes['default-styling'] ?? true),
                '' => $this->isTailwind && ($this->getActionWrapperAttributes['default-colors'] ?? true),
                'd-flex flex-cols py-2 space-x-2' => $this->isBootstrap && ($this->getActionWrapperAttributes['default-styling'] ?? true),
                '' => $this->isBootstrap && ($this->getActionWrapperAttributes['default-colors'] ?? true),
                'justify-start' => $this->getActionsPosition === 'left',
                'justify-center' => $this->getActionsPosition === 'center',
                'justify-end' => $this->getActionsPosition === 'right',
                'pl-2' => $this->showActionsInToolbar && $this->getActionsPosition === 'left',
                'pr-2' => $this->showActionsInToolbar && $this->getActionsPosition === 'right',
            ])
            ->except(['default','default-styling','default-colors'])
        }} >
    @foreach($this->getActions as $action)
        {{ $action->render() }}
    @endforeach
</div>
