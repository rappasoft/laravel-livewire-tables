@aware(['isTailwind','isBootstrap'])
@if ($this->offlineIndicatorIsEnabled())
    @if ($this->isTailwind)
        <div wire:offline.class.remove="hidden" class="hidden">
            <div class="rounded-md bg-red-100 p-4 mb-4 dark:border-red-800 dark:bg-red-500">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <x-heroicon-s-x-circle class="h-5 w-5 text-red-400 dark:text-white" />
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800 dark:text-white">
                            @lang('livewire-tables::You are not connected to the internet.')
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    @elseif ($this->isBootstrap)
        <div wire:offline.class.remove="d-none" class="d-none">
            <div class="alert alert-danger d-flex align-items-center">
                <x-heroicon-s-x-circle class="laravel-livewire-tables-btn-md" />
                <span class="d-inline-block ml-2">@lang('livewire-tables::You are not connected to the internet.')</span>
            </div>
        </div>
    @endif
@endif
