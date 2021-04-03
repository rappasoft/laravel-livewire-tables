@if ($tableHeaderEnabled)
    <thead class="bg-gray-50">
    @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.columns')
    </thead>
@endif
