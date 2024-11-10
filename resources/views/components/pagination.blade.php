@aware(['component','isTailwind','isBootstrap','isBootstrap4','isBootstrap5'])

@includeWhen(
    $this->hasConfigurableAreaFor('before-pagination'), 
    $this->getConfigurableAreaFor('before-pagination'), 
    $this->getParametersForConfigurableArea('before-pagination')
)

@if ($this->isTailwind)
    <div {{ $this->getPaginationWrapperAttributesBag() }}>
        @if ($this->paginationVisibilityIsEnabled())
            <div class="mt-4 px-4 md:p-0 sm:flex justify-between items-center space-y-4 sm:space-y-0">
                <div>
                    @if ($this->paginationIsEnabled() && $this->isPaginationMethod('standard') && $this->getRows->lastPage() > 1)
                        <p class="paged-pagination-results text-sm text-gray-700 leading-5 dark:text-white">
                            @if($this->showPaginationDetails())
                                <span>{{ __('livewire-tables::core.Showing') }}</span>
                                <span class="font-medium">{{ $this->getRows->firstItem() }}</span>
                                <span>{{ __('livewire-tables::core.to') }}</span>
                                <span class="font-medium">{{ $this->getRows->lastItem() }}</span>
                                <span>{{ __('livewire-tables::core.of') }}</span>
                                <span class="font-medium"><span x-text="paginationTotalItemCount"></span></span>
                                <span>{{ __('livewire-tables::core.results') }}</span>
                            @endif
                        </p>
                    @elseif ($this->paginationIsEnabled() && $this->isPaginationMethod('simple'))
                        <p class="paged-pagination-results text-sm text-gray-700 leading-5 dark:text-white">
                            @if($this->showPaginationDetails())
                                <span>{{ __('livewire-tables::core.Showing') }}</span>
                                <span class="font-medium">{{ $this->getRows->firstItem() }}</span>
                                <span>{{ __('livewire-tables::core.to') }}</span>
                                <span class="font-medium">{{ $this->getRows->lastItem() }}</span>
                            @endif
                        </p>
                    @elseif ($this->paginationIsEnabled() && $this->isPaginationMethod('cursor'))
                    @else
                        <p class="total-pagination-results text-sm text-gray-700 leading-5 dark:text-white">
                            {{ __('livewire-tables::core.Showing') }}
                            <span class="font-medium">{{ $this->getRows->count() }}</span>
                            {{ __('livewire-tables::core.results') }}
                        </p>
                    @endif
                </div>

                @if ($this->paginationIsEnabled())
                    {{ $this->getRows->links('livewire-tables::specific.tailwind.'.(!$this->isPaginationMethod('standard') ? 'simple-' : '').'pagination') }}
                @endif
            </div>
        @endif
    </div>
@elseif ($this->isBootstrap4)
    <div {{ $this->getPaginationWrapperAttributesBag() }}>
        @if ($this->paginationVisibilityIsEnabled())
            @if ($this->paginationIsEnabled() && $this->isPaginationMethod('standard') && $this->getRows->lastPage() > 1)
                <div class="row mt-3">
                    <div class="col-12 col-md-6 overflow-auto">
                        {{ $this->getRows->links('livewire-tables::specific.bootstrap-4.pagination') }}
                    </div>

                    <div class="col-12 col-md-6 text-center text-md-right text-muted">
                        @if($this->showPaginationDetails())
                            <span>{{ __('livewire-tables::core.Showing') }}</span>
                            <strong>{{ $this->getRows->count() ? $this->getRows->firstItem() : 0 }}</strong>
                            <span>{{ __('livewire-tables::core.to') }}</span>
                            <strong>{{ $this->getRows->count() ? $this->getRows->lastItem() : 0 }}</strong>
                            <span>{{ __('livewire-tables::core.of') }}</span>
                            <strong><span x-text="paginationTotalItemCount"></span></strong>
                            <span>{{ __('livewire-tables::core.results') }}</span>
                        @endif
                    </div>
                </div>
            @elseif ($this->paginationIsEnabled() && $this->isPaginationMethod('simple'))
                <div class="row mt-3">
                    <div class="col-12 col-md-6 overflow-auto">
                        {{ $this->getRows->links('livewire-tables::specific.bootstrap-4.simple-pagination') }}
                    </div>

                    <div class="col-12 col-md-6 text-center text-md-right text-muted">
                        @if($this->showPaginationDetails())
                            <span>{{ __('livewire-tables::core.Showing') }}</span>
                            <strong>{{ $this->getRows->count() ? $this->getRows->firstItem() : 0 }}</strong>
                            <span>{{ __('livewire-tables::core.to') }}</span>
                            <strong>{{ $this->getRows->count() ? $this->getRows->lastItem() : 0 }}</strong>
                        @endif
                    </div>
                </div>
            @elseif ($this->paginationIsEnabled() && $this->isPaginationMethod('cursor'))
                <div class="row mt-3">
                    <div class="col-12 col-md-6 overflow-auto">
                        {{ $this->getRows->links('livewire-tables::specific.bootstrap-4.simple-pagination') }}
                    </div>
                </div>
            @else
                <div class="row mt-3">
                    <div class="col-12 text-muted">
                        {{ __('livewire-tables::core.Showing') }}
                        <strong>{{ $this->getRows->count() }}</strong>
                        {{ __('livewire-tables::core.results') }}
                    </div>
                </div>
            @endif
        @endif
    </div>
@elseif ($this->isBootstrap5)
    <div {{ $this->getPaginationWrapperAttributesBag() }} >
        @if ($this->paginationVisibilityIsEnabled())
            @if ($this->paginationIsEnabled() && $this->isPaginationMethod('standard') && $this->getRows->lastPage() > 1)
                <div class="row mt-3">
                    <div class="col-12 col-md-6 overflow-auto">
                        {{ $this->getRows->links('livewire-tables::specific.bootstrap-4.pagination') }}
                    </div>
                    <div class="col-12 col-md-6 text-center text-md-end text-muted">
                        @if($this->showPaginationDetails())
                            <span>{{ __('livewire-tables::core.Showing') }}</span>
                            <strong>{{ $this->getRows->count() ? $this->getRows->firstItem() : 0 }}</strong>
                            <span>{{ __('livewire-tables::core.to') }}</span>
                            <strong>{{ $this->getRows->count() ? $this->getRows->lastItem() : 0 }}</strong>
                            <span>{{ __('livewire-tables::core.of') }}</span>
                            <strong><span x-text="paginationTotalItemCount"></span></strong>
                            <span>{{ __('livewire-tables::core.results') }}</span>
                        @endif
                    </div>
                </div>
            @elseif ($this->paginationIsEnabled() && $this->isPaginationMethod('simple'))
                <div class="row mt-3">
                    <div class="col-12 col-md-6 overflow-auto">
                        {{ $this->getRows->links('livewire-tables::specific.bootstrap-4.simple-pagination') }}
                    </div>
                    <div class="col-12 col-md-6 text-center text-md-end text-muted">
                        @if($this->showPaginationDetails())
                            <span>{{ __('livewire-tables::core.Showing') }}</span>
                            <strong>{{ $this->getRows->count() ? $this->getRows->firstItem() : 0 }}</strong>
                            <span>{{ __('livewire-tables::core.to') }}</span>
                            <strong>{{ $this->getRows->count() ? $this->getRows->lastItem() : 0 }}</strong>
                        @endif
                    </div>
                </div>
            @elseif ($this->paginationIsEnabled() && $this->isPaginationMethod('cursor'))
                <div class="row mt-3">
                    <div class="col-12 col-md-6 overflow-auto">
                        {{ $this->getRows->links('livewire-tables::specific.bootstrap-4.simple-pagination') }}
                    </div>
                </div>
            @else
                <div class="row mt-3">
                    <div class="col-12 text-muted">
                        {{ __('livewire-tables::core.Showing') }}
                        <strong>{{ $this->getRows->count() }}</strong>
                        {{ __('livewire-tables::core.results') }}
                    </div>
                </div>
            @endif
        @endif
    </div>
@endif

@includeWhen(
    $this->hasConfigurableAreaFor('after-pagination'), 
    $this->getConfigurableAreaFor('after-pagination'), 
    $this->getParametersForConfigurableArea('after-pagination')
)
