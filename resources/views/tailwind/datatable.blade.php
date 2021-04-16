<div
    @if (is_numeric($refresh)) wire:poll.{{ $refresh }}ms @elseif(is_string($refresh)) wire:poll="{{ $refresh }}" @endif
    class="flex-col space-y-4"
>
    @include('livewire-tables::tailwind.includes.offline')
    @include('livewire-tables::tailwind.includes.sorting-pills')
    @include('livewire-tables::tailwind.includes.filter-pills')

    <div class="md:flex md:justify-between p-6 md:p-0">
        <div class="w-full mb-4 md:mb-0 md:w-2/4 md:flex space-y-4 md:space-y-0 md:space-x-4">
            @include('livewire-tables::tailwind.includes.search')
            @include('livewire-tables::tailwind.includes.filters')
        </div>

        <div class="md:space-x-2 md:flex md:items-center">
            @include('livewire-tables::tailwind.includes.bulk-actions')

            <div class="w-full md:w-auto">
                @include('livewire-tables::tailwind.includes.per-page')
            </div>
        </div>
    </div>

    @include('livewire-tables::tailwind.includes.table')
    @include('livewire-tables::tailwind.includes.pagination')
</div>
