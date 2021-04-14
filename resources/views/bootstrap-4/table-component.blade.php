<div
    class="{{ $this->getOption('bootstrap.container') ? 'container-fluid' : '' }}"
    @if (is_numeric($refresh)) wire:poll.{{ $refresh }}ms @elseif(is_string($refresh)) wire:poll="{{ $refresh }}" @endif
>
    @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.offline')
    @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.options')

    @if ($this->getOption('bootstrap.responsive'))
        <div class="table-responsive">
    @endif
        <table class="{{ $this->getOption('bootstrap.classes.table') }}">
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
    @if ($this->getOption('bootstrap.responsive'))
        </div><!--table-responsive-->
    @endif

    @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.pagination')
</div>
