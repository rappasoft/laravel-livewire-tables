@aware(['component'])
@props(['rows', 'columns'])

<ul class="grid grid-cols-3 gap-4 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6">
    
    @forelse($rows as $row)

    <li wire:key="{{ $loop->index }}" class="col-span-1 bg-white border border-2 border-gray-300 rounded-md shadow cursor-pointer hover:border-af-blue-500">

        @foreach($columns as $colIndex => $column)
            {{ $column->renderContents($row) }}
        @endforeach
        
    </li>

    @empty

    <li class="col-span-1 bg-white divide-y divide-gray-200 shadow">
        <div class="flex content-center justify-center p-6">
            {{ $component->getEmptyMessage() }}
        </div>
    </li>

    @endforelse
</ul>