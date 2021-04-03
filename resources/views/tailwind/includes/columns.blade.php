<tr>
    @foreach($columns as $column)
        @if ($column->isVisible())
            @if($column->isSortable())
                <th
                    scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    id="{{ $this->setTableHeadId($column->getAttribute()) }}"
                @foreach ($this->setTableHeadAttributes($column->getAttribute()) as $key => $value)
                    {{ $key }}="{{ $value }}"
                @endforeach
                wire:click="sort('{{ $column->getAttribute() }}')"
                style="cursor:pointer;"
                >
            <div class="flex justify-between">
                {{ $column->getText() }}
                @if ($sortField !== $column->getAttribute())
                    <svg class="flex h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                @elseif ($sortDirection === 'asc')
                    <svg class="flex h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                    </svg>
                @else
                    <svg class="flex h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                    </svg>
                @endif
            </div>


                </th>
            @else
                <th
                    scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                    id="{{ $this->setTableHeadId($column->getAttribute()) }}"
                @foreach ($this->setTableHeadAttributes($column->getAttribute()) as $key => $value)
                    {{ $key }}="{{ $value }}"
                @endforeach
                >
                {{ $column->getText() }}
                </th>
            @endif
        @endif
    @endforeach
</tr>
