@aware(['component', 'tableName'])

    <div @class([
        'ml-0 ml-md-2' => $component->isBootstrap4(),
        'ms-0 ms-md-2' => $component->isBootstrap5(),
    ])>
        <select
            wire:model.live="perPage"
            id="{{ $tableName }}-perPage"
            @class([
                'form-control' => $component->isBootstrap4(),
                'form-select' => $component->isBootstrap5(),
            ])
        >
            @foreach ($component->getPerPageAccepted() as $item)
                <option
                    value="{{ $item }}"
                    wire:key="{{ $tableName }}-per-page-{{ $item }}"
                >
                    {{ $item === -1 ? __('All') : $item }}
                </option>
            @endforeach
        </select>
    </div>
@endif
