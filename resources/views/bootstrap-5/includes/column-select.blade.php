@if ($columnSelect)
    <div class="mb-3 mb-md-0 md-0 ms-md-2">
        <div
            x-data="{ open: false }"
            x-on:keydown.escape.stop="open = false"
            x-on:mousedown.away="open = false"
            class="dropdown d-block d-md-inline"
        >
            <button
                x-on:click="open = !open"
                class="btn dropdown-toggle d-block w-100 d-md-inline"
                type="button"
                aria-haspopup="true"
                x-bind:aria-expanded="open"
            >
                @lang('Columns')
            </button>

            <div
                class="dropdown-menu dropdown-menu-end w-100"
                x-bind:class="{'show' : open}"
            >
                @foreach($columns as $column)
                    @if ($column->isVisible() && $column->isSelectable())
                        <div wire:key="columnSelect-{{ $loop->index }}">
                            <label class="px-2 {{ $loop->last ? 'mb-0' : 'mb-1' }}">
                                <input
                                    wire:model="columnSelectEnabled"
                                    wire:target="columnSelectEnabled"
                                    wire:loading.attr="disabled"
                                    type="checkbox"
                                    value="{{ $column->column() }}"
                                />
                                <span class="ml-2">{{ $column->text() }}</span>
                            </label>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endif
