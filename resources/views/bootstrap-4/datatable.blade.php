<div
    @if (is_numeric($refresh)) wire:poll.{{ $refresh }}ms @elseif(is_string($refresh)) wire:poll="{{ $refresh }}" @endif
    class="container-fluid"
>
    @include('livewire-tables::bootstrap-4.includes.sorting-pills')
    @include('livewire-tables::bootstrap-4.includes.filter-pills')

    <div class="d-flex justify-content-between mb-3 p-3 p-md-0">
        <div class="d-flex">
            @include('livewire-tables::bootstrap-4.includes.search')

            <div class="ml-3">
                @include('livewire-tables::bootstrap-4.includes.filters')
            </div>
        </div>

        <div class="d-flex">
            @include('livewire-tables::bootstrap-4.includes.bulk-actions')

            <div class="ml-3">
                @include('livewire-tables::bootstrap-4.includes.per-page')
            </div>
        </div>
    </div>

    @include('livewire-tables::bootstrap-4.includes.table')
    @include('livewire-tables::bootstrap-4.includes.pagination')
</div>
