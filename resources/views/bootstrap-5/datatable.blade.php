<div
    @if (is_numeric($refresh))
        wire:poll.{{ $refresh }}ms
    @elseif(is_string($refresh))
        @if ($refresh === '.keep-alive' || $refresh === 'keep-alive')
            wire:poll.keep-alive
        @elseif($refresh === '.visible' || $refresh === 'visible')
            wire:poll.visible
        @else
            wire:poll="{{ $refresh }}"
        @endif
    @endif
    class="container-fluid p-0"
>
    @include('livewire-tables::bootstrap-5.includes.offline')
    @include('livewire-tables::bootstrap-5.includes.sorting-pills')
    @include('livewire-tables::bootstrap-5.includes.filter-pills')

    <div class="d-md-flex justify-content-between mb-3">
        <div class="d-md-flex">
            @include('livewire-tables::bootstrap-5.includes.search')

            <div class="ms-0 ms-md-3 mb-3 mb-md-0">
                @include('livewire-tables::bootstrap-5.includes.filters')
            </div>
        </div>

        <div class="d-md-flex">
            @include('livewire-tables::bootstrap-5.includes.bulk-actions')
            @include('livewire-tables::bootstrap-5.includes.per-page')
        </div>
    </div>

    @include('livewire-tables::bootstrap-5.includes.table')
    @include('livewire-tables::bootstrap-5.includes.pagination')
</div>
