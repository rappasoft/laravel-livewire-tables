@if ($offlineIndicator)
    <div wire:offline.class="block" wire:offline.class.remove="hidden" class="alert alert-danger hidden">
        @lang('laravel-livewire-tables::strings.offline')
    </div>
@endif
