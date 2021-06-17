@if ($columnSelect)
    <div class="dropdown mb-3 mb-md-0 pl-0 pl-md-3 d-block d-md-inline">
        <button class="btn dropdown-toggle d-block w-100 d-md-inline" type="button" id="columnSelect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @lang('Columns')
        </button>

        <div class="dropdown-menu dropdown-menu-right w-100" aria-labelledby="columnSelect">
            @foreach($columns as $column)
                @if ($column->isVisible() && $column->isSelectable())
                    <div>
                        <label class="px-2 {{ $loop->last ? 'mb-0' : 'mb-1' }}">
                            <input wire:model="columnSelectEnabled" type="checkbox" value="{{ $column->column() }}">
                            <span class="ml-2">{{ $column->text() }}</span>
                        </label>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endif
