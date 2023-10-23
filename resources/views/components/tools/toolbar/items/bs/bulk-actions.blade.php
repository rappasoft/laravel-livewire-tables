@aware(['component', 'tableName'])
<div
                x-cloak
                x-show="(selectedItems.length > 0 || alwaysShowBulkActions)"
                @class([
                    'mb-3 mb-md-0' => $component->isBootstrap(),
                ])
            >
                <div @class([
                    'dropdown d-block d-md-inline' => $component->isBootstrap(),
                ])>
                    <button
                        @class([
                            'btn dropdown-toggle d-block w-100 d-md-inline' => $component->isBootstrap(),
                        ])
                        type="button"
                        id="{{ $tableName }}-bulkActionsDropdown" data-toggle="dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        @lang('Bulk Actions')
                    </button>

                    <div
                        @class([
                            'dropdown-menu dropdown-menu-right w-100' => $component->isBootstrap4(),
                            'dropdown-menu dropdown-menu-end w-100' => $component->isBootstrap5(),
                        ])
                        aria-labelledby="{{ $tableName }}-bulkActionsDropdown"
                    >
                        @foreach ($component->getBulkActions() as $action => $title)
                            <a
                                href="#"
                                wire:click="{{ $action }}"
                                wire:key="{{ $tableName }}-bulk-action-{{ $action }}"
                                @class([
                                    'dropdown-item' => $component->isBootstrap(),
                                ])
                            >
                                {{ $title }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
