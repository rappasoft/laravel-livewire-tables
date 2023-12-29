@aware(['component'])
@props(['rows'])

@if ($component->hasConfigurableAreaFor('before-pagination'))
    @include($component->getConfigurableAreaFor('before-pagination'), $component->getParametersForConfigurableArea('before-pagination'))
@endif

@if ($component->isTailwind())
    <div>
        @if ($component->paginationIsEnabled() && $component->paginationVisibilityIsEnabled())
            <div class="mt-4 px-4 md:p-0 sm:flex justify-between items-center space-y-4 sm:space-y-0">
                <div>
                    @if ($component->isPaginationMethod('standard') && $component->showPaginationDetails() && $rows->lastPage() > 1)
                        <p class="paged-pagination-results text-sm text-gray-700 leading-5 dark:text-white">
                            <span>@lang('Showing')</span>
                            <span class="font-medium">{{ $rows->firstItem() }}</span>
                            <span>@lang('to')</span>
                            <span class="font-medium">{{ $rows->lastItem() }}</span>
                            <span>@lang('of')</span>
                            <span class="font-medium"><span x-text="paginationTotalItemCount"></span></span>
                            <span>@lang('results')</span>
                        </p>
                    @elseif ($component->isPaginationMethod('simple') && $component->showPaginationDetails())
                        <p class="paged-pagination-results text-sm text-gray-700 leading-5 dark:text-white">
                            <span>@lang('Showing')</span>
                            <span class="font-medium">{{ $rows->firstItem() }}</span>
                            <span>@lang('to')</span>
                            <span class="font-medium">{{ $rows->lastItem() }}</span>
                        </p>
                    @elseif ($component->isPaginationMethod('cursor') && $component->showPaginationDetails())
                    @else
                        @if($component->showPaginationDetails())
                        <p class="total-pagination-results text-sm text-gray-700 leading-5 dark:text-white">

                            @lang('Showing')
                            <span class="font-medium">{{ $rows->count() }}</span>
                            @lang('results')
                            </p>

                        @endif
                    @endif
                </div>
                {{ $rows->links('livewire-tables::specific.tailwind.'.(!$component->isPaginationMethod('standard') ? 'simple-' : '').'pagination') }}
            </div>
        @endif
    </div>
@elseif ($component->isBootstrap4())
    <div >
        @if ($component->paginationIsEnabled() && $component->paginationVisibilityIsEnabled())
            @if ($component->isPaginationMethod('standard') && $rows->lastPage() > 1)
                <div class="row mt-3">
                    <div class="col-12 col-md-6 overflow-auto">
                        {{ $rows->links('livewire-tables::specific.bootstrap-4.pagination') }}
                    </div>
                    @if($component->showPaginationDetails())
                        <div class="col-12 col-md-6 text-center text-md-right text-muted">
                            <span>@lang('Showing')</span>
                            <strong>{{ $rows->count() ? $rows->firstItem() : 0 }}</strong>
                            <span>@lang('to')</span>
                            <strong>{{ $rows->count() ? $rows->lastItem() : 0 }}</strong>
                            <span>@lang('of')</span>
                            <strong><span x-text="paginationTotalItemCount"></span></strong>
                            <span>@lang('results')</span>
                        </div>
                    @endif
                </div>
            @elseif ($component->isPaginationMethod('simple'))
                <div class="row mt-3">
                    <div class="col-12 col-md-6 overflow-auto">
                        {{ $rows->links('livewire-tables::specific.bootstrap-4.simple-pagination') }}
                    </div>
                    @if($component->showPaginationDetails())
                        <div class="col-12 col-md-6 text-center text-md-right text-muted">
                            <span>@lang('Showing')</span>
                            <strong>{{ $rows->count() ? $rows->firstItem() : 0 }}</strong>
                            <span>@lang('to')</span>
                            <strong>{{ $rows->count() ? $rows->lastItem() : 0 }}</strong>
                        </div>
                    @endif
                </div>
            @elseif ($component->isPaginationMethod('cursor'))
                <div class="row mt-3">
                    <div class="col-12 col-md-6 overflow-auto">
                        {{ $rows->links('livewire-tables::specific.bootstrap-4.simple-pagination') }}
                    </div>
                </div>
            @else
                <div class="row mt-3">
                @if($component->showPaginationDetails())
                    <div class="col-12 text-muted">
                        @lang('Showing')
                        <strong>{{ $rows->count() }}</strong>
                        @lang('results')
                    </div>
                @endif
                </div>
            @endif
        @endif
    </div>
@elseif ($component->isBootstrap5())
    <div >
        @if ($component->paginationIsEnabled() && $component->paginationVisibilityIsEnabled())
            @if ($component->isPaginationMethod('standard') && $rows->lastPage() > 1)
                <div class="row mt-3">
                    <div class="col-12 col-md-6 overflow-auto">
                        {{ $rows->links('livewire-tables::specific.bootstrap-4.pagination') }}
                    </div>
                    @if($component->showPaginationDetails())
                        <div class="col-12 col-md-6 text-center text-md-end text-muted">
                            <span>@lang('Showing')</span>
                            <strong>{{ $rows->count() ? $rows->firstItem() : 0 }}</strong>
                            <span>@lang('to')</span>
                            <strong>{{ $rows->count() ? $rows->lastItem() : 0 }}</strong>
                            <span>@lang('of')</span>
                            <strong><span x-text="paginationTotalItemCount"></span></strong>
                            <span>@lang('results')</span>
                        </div>
                    @endif
                </div>
            @elseif ($component->isPaginationMethod('simple'))
                <div class="row mt-3">
                    <div class="col-12 col-md-6 overflow-auto">
                        {{ $rows->links('livewire-tables::specific.bootstrap-4.simple-pagination') }}
                    </div>
                    @if($component->showPaginationDetails())
                        <div class="col-12 col-md-6 text-center text-md-end text-muted">
                            <span>@lang('Showing')</span>
                            <strong>{{ $rows->count() ? $rows->firstItem() : 0 }}</strong>
                            <span>@lang('to')</span>
                            <strong>{{ $rows->count() ? $rows->lastItem() : 0 }}</strong>
                        </div>
                    @endif
                </div>
            @elseif ($component->isPaginationMethod('cursor'))
                <div class="row mt-3">
                    <div class="col-12 col-md-6 overflow-auto">
                        {{ $rows->links('livewire-tables::specific.bootstrap-4.simple-pagination') }}
                    </div>
                </div>
            @else
                <div class="row mt-3">
                @if($component->showPaginationDetails())

                    <div class="col-12 text-muted">
                        @lang('Showing')
                        <strong>{{ $rows->count() }}</strong>
                        @lang('results')
                    </div>
                    @endif
                </div>
            @endif
        @endif
    </div>
@endif

@if ($component->hasConfigurableAreaFor('after-pagination'))
    @include($component->getConfigurableAreaFor('after-pagination'), $component->getParametersForConfigurableArea('after-pagination'))
@endif
