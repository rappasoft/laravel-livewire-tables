@aware([ 'tableName'])

@if ($this->bulkActionsAreEnabled() && $this->hasBulkActions())
    @php
        $colspan = $this->getColspanCount();
        $selectAll = $this->selectAllIsEnabled();
        $simplePagination = $this->isPaginationMethod('simple');
    @endphp

    <x-livewire-tables::table.tr.plain
        x-cloak x-show="selectedItems.length > 0 && !currentlyReorderingStatus"
        wire:key="{{ $tableName }}-bulk-select-message"
        @class([
            'bg-indigo-50 dark:bg-gray-900 dark:text-white' => $this->isTailwind,
        ])
    >
        <x-livewire-tables::table.td.plain :colspan="$colspan">
            <template x-if="selectedItems.length == paginationTotalItemCount || selectAllStatus">
                <div wire:key="{{ $tableName }}-all-selected">
                    <span>
                        {{ __($this->getLocalisationPath.'You are currently selecting all') }}
                        @if(!$simplePagination) <strong><span x-text="paginationTotalItemCount"></span></strong> @endif
                        {{ __($this->getLocalisationPath.'rows') }}.
                    </span>

                    <button
                        x-on:click="clearSelected"
                        wire:loading.attr="disabled"
                        type="button"
                        {{ 
                            $this->getBulkActionsRowButtonAttributesBag->class([
                                'ml-1 underline text-sm leading-5 font-medium focus:outline-none focus:underline transition duration-150 ease-in-out' => $this->isTailwind && ($this->getBulkActionsRowButtonAttributes['default-styling'] ?? true),
                                'text-blue-600 text-gray-700 focus:text-gray-800 dark:text-white dark:hover:text-gray-400' => $this->isTailwind && ($this->getBulkActionsRowButtonAttributes['default-colors'] ?? true),
                                'btn btn-primary btn-sm' => $this->isBootstrap && ($this->getBulkActionsRowButtonAttributes['default-styling'] ?? true)
                            ])
                        }}
                    >
                        {{ __($this->getLocalisationPath.'Deselect All') }}
                    </button>
                </div>
            </template>

            <template x-if="selectedItems.length !== paginationTotalItemCount && !selectAllStatus">
                <div wire:key="{{ $tableName }}-some-selected">
                    <span>
                        {{ __($this->getLocalisationPath.'You have selected') }}
                        <strong><span x-text="selectedItems.length"></span></strong>
                        {{ __($this->getLocalisationPath.'rows, do you want to select all') }}
                        @if(!$simplePagination) <strong><span x-text="paginationTotalItemCount"></span></strong> @endif
                    </span>

                    <button
                        x-on:click="selectAllOnPage()"
                        wire:loading.attr="disabled"
                        type="button"
                        {{ 
                            $this->getBulkActionsRowButtonAttributesBag->class([
                                'ml-1 underline text-sm leading-5 font-medium focus:outline-none focus:underline transition duration-150 ease-in-out' => $this->isTailwind && ($this->getBulkActionsRowButtonAttributes['default-styling'] ?? true),
                                'text-blue-600 text-gray-700 focus:text-gray-800 dark:text-white dark:hover:text-gray-400' => $this->isTailwind && ($this->getBulkActionsRowButtonAttributes['default-colors'] ?? true),
                                'btn btn-primary btn-sm' => $this->isBootstrap && ($this->getBulkActionsRowButtonAttributes['default-styling'] ?? true)
                            ])
                        }}

                    >{{ __($this->getLocalisationPath.'Select All On Page') }}
                    </button>&nbsp;

                    <button
                        x-on:click="setAllSelected()"
                        wire:loading.attr="disabled"
                        type="button"
                        {{ 
                            $this->getBulkActionsRowButtonAttributesBag->class([
                                'ml-1 underline text-sm leading-5 font-medium focus:outline-none focus:underline transition duration-150 ease-in-out' => $this->isTailwind && ($this->getBulkActionsRowButtonAttributes['default-styling'] ?? true),
                                'text-blue-600 text-gray-700 focus:text-gray-800 dark:text-white dark:hover:text-gray-400' => $this->isTailwind && ($this->getBulkActionsRowButtonAttributes['default-colors'] ?? true),
                                'btn btn-primary btn-sm' => $this->isBootstrap && ($this->getBulkActionsRowButtonAttributes['default-styling'] ?? true)
                            ])
                        }}
                    >
                        {{ __($this->getLocalisationPath.'Select All') }}
                    </button>

                    <button
                        x-on:click="clearSelected"
                        wire:loading.attr="disabled"
                        type="button"
                        {{ 
                            $this->getBulkActionsRowButtonAttributesBag->class([
                                'ml-1 underline text-sm leading-5 font-medium focus:outline-none focus:underline transition duration-150 ease-in-out' => $this->isTailwind && ($this->getBulkActionsRowButtonAttributes['default-styling'] ?? true),
                                'text-blue-600 text-gray-700 focus:text-gray-800 dark:text-white dark:hover:text-gray-400' => $this->isTailwind && ($this->getBulkActionsRowButtonAttributes['default-colors'] ?? true),
                                'btn btn-primary btn-sm' => $this->isBootstrap && ($this->getBulkActionsRowButtonAttributes['default-styling'] ?? true)
                            ])
                        }}
                    >
                        {{ __($this->getLocalisationPath.'Deselect All') }}
                    </button>
                </div>
            </template>
        </x-livewire-tables::table.td.plain>
    </x-livewire-tables::table.tr.plain>
@endif
