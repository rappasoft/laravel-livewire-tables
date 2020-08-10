@if ($offlineIndicator)
    <div class="row">
        <div class="col-12">
            <div wire:offline class="alert alert-danger">
                <i class="fa fa-info-circle"></i> @lang('laravel-livewire-tables::strings.offline')
            </div>
        </div>
    </div>
@endif
