<div>
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
    >
        @include('livewire-tables::tailwind.includes.offline')

        <div class="flex-col">
            @include('livewire-tables::tailwind.includes.sorting-pills')
            @include('livewire-tables::tailwind.includes.filter-pills')

            <div class="space-y-4">
                <div class="md:flex md:justify-between p-6 md:p-0">
                    <div class="w-full mb-4 md:mb-0 md:w-2/4 md:flex space-y-4 md:space-y-0 md:space-x-4">
                        @include('livewire-tables::tailwind.includes.reorder')
                        @include('livewire-tables::tailwind.includes.search')
                        @include('livewire-tables::tailwind.includes.filters')
                    </div>

                    <div class="md:space-x-2 md:flex md:items-center">
                        @include('livewire-tables::tailwind.includes.bulk-actions')
                        @include('livewire-tables::tailwind.includes.column-select')
                        @include('livewire-tables::tailwind.includes.per-page')
                    </div>
                </div>

                @include('livewire-tables::tailwind.includes.table')
                @include('livewire-tables::tailwind.includes.pagination')
            </div>
        </div>
    </div>

    @isset($modalsView)
        @include($modalsView)
    @endisset
</div>
