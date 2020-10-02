@if ($tableFooterEnabled)
    <tfoot>
        @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.columns')
    </tfoot>
@endif
