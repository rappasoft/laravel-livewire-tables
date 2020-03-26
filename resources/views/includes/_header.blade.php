@if ($tableHeaderEnabled)
    <thead class="{{ $tableHeaderClass }}">
        @include('laravel-livewire-tables::includes._columns')
    </thead>
@endif
