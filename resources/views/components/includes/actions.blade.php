<div {{ $attributes
            ->merge($this->getActionWrapperAttributes())
            ->class(['d-flex flex-cols justify-center' => $this->isBootstrap && $this->getActionWrapperAttributes()['default'] ?? true])
            ->class(['flex flex-cols justify-center' => $this->isTailwind && $this->getActionWrapperAttributes()['default'] ?? true])

            ->except('default')
        }} >
    @foreach($this->getActions as $action)
        {{ $action->render() }}
    @endforeach
</div>