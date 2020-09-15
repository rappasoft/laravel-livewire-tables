<div class="container-fluid" @if (is_numeric($refresh)) wire:poll.{{ $refresh }}.ms @elseif(is_string($refresh)) wire:poll="{{ $refresh }}" @endif>
    @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.offline')
    @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.options')

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.thead')

            @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.loading')
                @if($models->isEmpty())
                    @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.empty')
                @else
                    @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.data')
                @endif
            </tbody>

            @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.tfoot')
        </table>
    </div><!--table-responsive-->

    @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.pagination')
</div>
