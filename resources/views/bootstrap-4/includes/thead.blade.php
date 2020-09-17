@if ($tableHeaderEnabled)
    <thead>
        @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.columns')
    </thead>
@endif
