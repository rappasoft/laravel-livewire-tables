<div class="flex flex-col">sdfsdf
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                 @if (is_numeric($refresh)) wire:poll.{{ $refresh }}.ms @elseif(is_string($refresh)) wire:poll="{{ $refresh }}" @endif
            >
                @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.offline')
                @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.options')

                <table class="min-w-full divide-y divide-gray-200">
                    @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.thead')
                    <tbody>
                    @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.loading')
                    @if($models->isEmpty())
                        @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.empty')
                    @else
                        @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.data')
                    @endif
                    </tbody>

                    @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.tfoot')
                </table>


                @include('laravel-livewire-tables::'.config('laravel-livewire-tables.theme').'.includes.pagination')
            </div>
        </div>
    </div>
</div>
