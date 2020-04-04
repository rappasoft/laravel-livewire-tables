@if (is_numeric($refresh))
    <div class="{{ $wrapperClass }}" wire:poll.{{ $refresh }}.ms>
@elseif (is_string($refresh))
    <div class="{{ $wrapperClass }}" wire:poll="{{ $refresh }}">
@else
    <div class="{{ $wrapperClass }}">
@endif
    @include('laravel-livewire-tables::includes._offline')
    @include('laravel-livewire-tables::includes._options')
    @include('laravel-livewire-tables::includes._loading')

    @if (is_string($responsive))
        <div class="{{ $responsive }}">
    @endif

        <table class="{{ $tableClass }}">
            @include('laravel-livewire-tables::includes._header')
            @include('laravel-livewire-tables::includes._body')
            @include('laravel-livewire-tables::includes._footer')
        </table>

    @if (is_string($responsive))
        </div>
    @endif

    @include('laravel-livewire-tables::includes._pagination')
</div>
