@if ($this->hasConfigurableAreaFor('before-pagination'))
    @include($this->getConfigurableAreaFor('before-pagination'), $this->getParametersForConfigurableArea('before-pagination'))
@endif

@if ($this->isTailwind)
    <div>
        @if ($this->paginationVisibilityIsEnabled())
            <div class="mt-4 px-4 md:p-0 sm:flex justify-between items-center space-y-4 sm:space-y-0">
                <div>
                    @if ($this->paginationIsEnabled() && $this->isPaginationMethod('standard') && $this->getRows->lastPage() > 1)
                        <p class="paged-pagination-results text-sm text-gray-700 leading-5 dark:text-white">
                            @if($this->showPaginationDetails())
                                <span>@lang('Showing')</span>
                                <span class="font-medium">{{ $this->getRows->firstItem() }}</span>
                                <span>@lang('to')</span>
                                <span class="font-medium">{{ $this->getRows->lastItem() }}</span>
                                <span>@lang('of')</span>
                                <span class="font-medium"><span x-text="paginationTotalItemCount"></span></span>
                                <span>@lang('results')</span>
                            @endif
                        </p>
                    @elseif ($this->paginationIsEnabled() && $this->isPaginationMethodSimple)
                        <p class="paged-pagination-results text-sm text-gray-700 leading-5 dark:text-white">
                            @if($this->showPaginationDetails())
                                <span>@lang('Showing')</span>
                                <span class="font-medium">{{ $this->getRows->firstItem() }}</span>
                                <span>@lang('to')</span>
                                <span class="font-medium">{{ $this->getRows->lastItem() }}</span>
                            @endif
                        </p>
                    @elseif ($this->paginationIsEnabled() && $this->isPaginationMethod('cursor'))
                    @else
                        <p class="total-pagination-results text-sm text-gray-700 leading-5 dark:text-white">
                            @lang('Showing')
                            <span class="font-medium">{{ $this->getRows->count() }}</span>
                            @lang('results')
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
    <div >
        @if ($this->paginationVisibilityIsEnabled())
            @if ($this->paginationIsEnabled() && $this->isPaginationMethod('standard') && $this->getRows->lastPage() > 1)
                <div class="row mt-3">
                    <div class="col-12 col-md-6 overflow-auto">
                        {{ $this->getRows->links('livewire-tables::specific.bootstrap-4.pagination') }}
                    </div>

                    <div class="col-12 col-md-6 text-center text-md-right text-muted">
                        @if($this->showPaginationDetails())
                            <span>@lang('Showing')</span>
                            <strong>{{ $this->getRows->count() ? $this->getRows->firstItem() : 0 }}</strong>
                            <span>@lang('to')</span>
                            <strong>{{ $this->getRows->count() ? $this->getRows->lastItem() : 0 }}</strong>
                            <span>@lang('of')</span>
                            <strong><span x-text="paginationTotalItemCount"></span></strong>
                            <span>@lang('results')</span>
                        @endif
                    </div>
                </div>
            @elseif ($this->paginationIsEnabled() && $this->isPaginationMethodSimple)
                <div class="row mt-3">
                    <div class="col-12 col-md-6 overflow-auto">
                        {{ $this->getRows->links('livewire-tables::specific.bootstrap-4.simple-pagination') }}
                    </div>

                    <div class="col-12 col-md-6 text-center text-md-right text-muted">
                        @if($this->showPaginationDetails())
                            <span>@lang('Showing')</span>
                            <strong>{{ $this->getRows->count() ? $this->getRows->firstItem() : 0 }}</strong>
                            <span>@lang('to')</span>
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
                        @lang('Showing')
                        <strong>{{ $this->getRows->count() }}</strong>
                        @lang('results')
                    </div>
                </div>
            @endif
        @endif
    </div>
@elseif ($this->isBootstrap5)
    <div >
        @if ($this->paginationVisibilityIsEnabled())
            @if ($this->paginationIsEnabled() && $this->isPaginationMethod('standard') && $this->getRows->lastPage() > 1)
                <div class="row mt-3">
                    <div class="col-12 col-md-6 overflow-auto">
                        {{ $this->getRows->links('livewire-tables::specific.bootstrap-4.pagination') }}
                    </div>
                    <div class="col-12 col-md-6 text-center text-md-end text-muted">
                        @if($this->showPaginationDetails())
                            <span>@lang('Showing')</span>
                            <strong>{{ $this->getRows->count() ? $this->getRows->firstItem() : 0 }}</strong>
                            <span>@lang('to')</span>
                            <strong>{{ $this->getRows->count() ? $this->getRows->lastItem() : 0 }}</strong>
                            <span>@lang('of')</span>
                            <strong><span x-text="paginationTotalItemCount"></span></strong>
                            <span>@lang('results')</span>
                        @endif
                    </div>
                </div>
            @elseif ($this->paginationIsEnabled() && $this->isPaginationMethodSimple)
                <div class="row mt-3">
                    <div class="col-12 col-md-6 overflow-auto">
                        {{ $this->getRows->links('livewire-tables::specific.bootstrap-4.simple-pagination') }}
                    </div>
                    <div class="col-12 col-md-6 text-center text-md-end text-muted">
                        @if($this->showPaginationDetails())
                            <span>@lang('Showing')</span>
                            <strong>{{ $this->getRows->count() ? $this->getRows->firstItem() : 0 }}</strong>
                            <span>@lang('to')</span>
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
                        @lang('Showing')
                        <strong>{{ $this->getRows->count() }}</strong>
                        @lang('results')
                    </div>
                </div>
            @endif
        @endif
    </div>
@endif

@if ($this->hasConfigurableAreaFor('after-pagination'))
    @include($this->getConfigurableAreaFor('after-pagination'), $this->getParametersForConfigurableArea('after-pagination'))
@endif