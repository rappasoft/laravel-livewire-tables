@if ($tableHeaderEnabled)
    <thead class="{{ $this->getOption('bootstrap.classes.thead') }}">
        @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.columns')
    </thead>
@endif
