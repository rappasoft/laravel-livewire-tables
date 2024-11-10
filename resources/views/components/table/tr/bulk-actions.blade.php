@aware(['component', 'tableName','isTailwind','isBootstrap'])

@if ($this->bulkActionsAreEnabled() && $this->hasBulkActions())
    @php
        $colspan = $this->getColspanCount();
        $selectAll = $this->selectAllIsEnabled();
        $simplePagination = $this->isPaginationMethod('simple');
    @endphp

    @if ($isTailwind)
        <x-livewire-tables::table.tr.plain
            x-cloak x-show="selectedItems.length > 0 && !currentlyReorderingStatus"
            wire:key="{{ $tableName }}-bulk-select-message"
            class="bg-indigo-50 dark:bg-gray-900 dark:text-white"
        >
            <x-livewire-tables::table.td.plain :colspan="$colspan">
                <template x-if="selectedItems.length == paginationTotalItemCount || selectAllStatus">
                    <div wire:key="{{ $tableName }}-all-selected">
                        <span>
                            {{ __('livewire-tables::core.You are currently selecting all') }}
                            @if(!$simplePagination) <strong><span x-text="paginationTotalItemCount"></span></strong> @endif
                            {{ __('livewire-tables::core.rows') }}.
                        </span>

                        <button
                            x-on:click="clearSelected"
                            wire:loading.attr="disabled"
                            type="button"
                            class="ml-1 text-blue-600 underline text-gray-700 text-sm leading-5 font-medium focus:outline-none focus:text-gray-800 focus:underline transition duration-150 ease-in-out dark:text-white dark:hover:text-gray-400"
                        >
                            {{ __('livewire-tables::core.Deselect All') }}
                        </button>
                    </div>
                </template>

                <template x-if="selectedItems.length !== paginationTotalItemCount && !selectAllStatus">
                    <div wire:key="{{ $tableName }}-some-selected">
                        <span>
                            {{ __('livewire-tables::core.You have selected') }}
                            <strong><span x-text="selectedItems.length"></span></strong>
                            {{ __('livewire-tables::core.rows, do you want to select all') }}
                            @if(!$simplePagination) <strong><span x-text="paginationTotalItemCount"></span></strong> @endif
                        </span>

                        <button
                            x-on:click="selectAllOnPage()"
                            wire:loading.attr="disabled"
                            type="button"
                            class="ml-1 text-blue-600 underline text-gray-700 text-sm leading-5 font-medium focus:outline-none focus:text-gray-800 focus:underline transition duration-150 ease-in-out dark:text-white dark:hover:text-gray-400"
                        >{{ __('livewire-tables::core.Select All On Page') }}
                        </button>&nbsp;

                        <button
                            x-on:click="setAllSelected()"
                            wire:loading.attr="disabled"
                            type="button"
                            class="ml-1 text-blue-600 underline text-gray-700 text-sm leading-5 font-medium focus:outline-none focus:text-gray-800 focus:underline transition duration-150 ease-in-out dark:text-white dark:hover:text-gray-400"
                        >
                            {{ __('livewire-tables::core.Select All') }}
                        </button>

                        <button
                            x-on:click="clearSelected"
                            wire:loading.attr="disabled"
                            type="button"
                            class="ml-1 text-blue-600 underline text-gray-700 text-sm leading-5 font-medium focus:outline-none focus:text-gray-800 focus:underline transition duration-150 ease-in-out dark:text-white dark:hover:text-gray-400"
                        >
                            {{ __('livewire-tables::core.Deselect All') }}
                        </button>
                    </div>
                </template>
            </x-livewire-tables::table.td.plain>
        </x-livewire-tables::table.tr.plain>
    @elseif ($isBootstrap)
        <x-livewire-tables::table.tr.plain
            x-cloak x-show="selectedItems.length > 0 && !currentlyReorderingStatus"
            wire:key="{{ $tableName }}-bulk-select-message"
        >
            <x-livewire-tables::table.td.plain :colspan="$colspan">
                <template x-if="selectedItems.length == paginationTotalItemCount || selectAllStatus">
                    <div wire:key="{{ $tableName }}-all-selected">
                        <span>
                        {{ __('livewire-tables::core.You are currently selecting all') }}
                        @if(!$simplePagination) <strong><span x-text="paginationTotalItemCount"></span></strong> @endif
                            {{ __('livewire-tables::core.rows') }}.

                        </span>

                        <button
                            x-on:click="clearSelected"
                            wire:loading.attr="disabled"
                            type="button"
                            class="btn btn-primary btn-sm"
                        >
                        {{ __('livewire-tables::core.Deselect All') }}
                        </button>
                    </div>
                </template>

                <template x-if="selectedItems.length !== paginationTotalItemCount && !selectAllStatus">
                    <div wire:key="{{ $tableName }}-some-selected">
                        <span>
                            {{ __('livewire-tables::core.You have selected') }}
                            <strong><span x-text="selectedItems.length"></span></strong>
                            {{ __('livewire-tables::core.rows, do you want to select all') }}
                            @if(!$simplePagination) <strong><span x-text="paginationTotalItemCount"></span></strong> @endif
                        </span>

                        <button
                            x-on:click="selectAllOnPage"
                            wire:loading.attr="disabled"
                            type="button"
                            class="btn btn-primary btn-sm"
                        >
                            {{ __('livewire-tables::core.Select All On Page') }}
                        </button>&nbsp;

                        <button
                            x-on:click="setAllSelected()"
                            wire:loading.attr="disabled"
                            type="button"
                            class="btn btn-primary btn-sm"
                        >
                            {{ __('livewire-tables::core.Select All') }}
                        </button>

                        <button
                            x-on:click="clearSelected"
                            wire:loading.attr="disabled"
                            type="button"
                            class="btn btn-primary btn-sm"
                        >
                            {{ __('livewire-tables::core.Deselect All') }}
                        </button>
                    </div>
                </template>
            </x-livewire-tables::table.td.plain>
        </x-livewire-tables::table.tr.plain>
    @endif
@endif
