<div class="mt-1 relative rounded-md">
    @foreach($filter->options() as $optionKey => $value)
        <div wire:key="filter-{{ $key }}-multiselect-{{ $optionKey }}">
            <input
                type="checkbox"
                id="filter-{{$key}}-{{ $loop->index }}"
                wire:key="filter-{{$key}}-{{ $loop->index }}"
                wire:model="filters.{{$key}}"
                value="{{ $optionKey }}"
            >
            <label for="filter-{{$key}}-{{ $loop->index }}">{{ $value }}</label>
        </div>
    @endforeach
</div>
