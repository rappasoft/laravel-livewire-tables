<thead>
    <tr>
        @if (count($bulkActions))
            <th>
                <input
                    wire:model="selectPage"
                    type="checkbox"
                />
            </th>
        @endif

        @foreach($columns as $column)
            @if ($column->isBlank())
                <th></th>
            @else
                @include('livewire-tables::bootstrap-4.includes.heading')
            @endif
        @endforeach
    </tr>
</thead>
