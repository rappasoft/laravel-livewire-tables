@if ($offlineIndicator)
    <div wire:offline.class="d-block" wire:offline.class.remove="d-none" class="alert alert-danger d-none">
        @lang('laravel-livewire-tables::strings.offline')
    </div>
@endif
