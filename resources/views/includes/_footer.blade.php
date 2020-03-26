@if ($tableFooterEnabled)
    <tfoot class="{{ $tableFooterClass }}">
        @include('laravel-livewire-tables::includes._columns')
    </tfoot>
@endif
