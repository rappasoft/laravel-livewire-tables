@if ($this->showBulkActionsDropdown)
    <div class="mb-3 mb-md-0" id="{{ $bulkKey = \Illuminate\Support\Str::random() }}-bulkActionsWrapper">
        <div class="dropdown d-block d-md-inline">
            <button class="btn dropdown-toggle d-block w-100 d-md-inline" type="button" id="{{ $bulkKey }}-bulkActions" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @lang('Bulk Actions')
            </button>

            <div class="dropdown-menu dropdown-menu-end w-100" aria-labelledby="{{ $bulkKey }}-bulkActions">
                @foreach($this->bulkActions as $action => $title)
                    <a
                        href="#"
                        wire:click.prevent="{{ $action }}"
                        wire:key="bulk-action-{{ $action }}"
                        class="dropdown-item"
                    >
                        {{ $title }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endif
