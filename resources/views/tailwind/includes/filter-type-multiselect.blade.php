<div class="mt-1 relative rounded-md">
    <div>
        <input
            type="checkbox"
            id="filter-{{$key}}-select-all"
            wire:input="selectAllFilters('{{ $key }}')"
            {{ count($filters[$key]) === count($filter->options()) ? 'checked' : ''}}
        >
        <label for="filter-{{$key}}-select-all">@lang('All')</label>
    </div>
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
