<div class="form-check">
    <input
        class="form-check-input"
        onclick="event.stopPropagation();"
        type="checkbox"
        id="filter-{{$key}}-select-all"
        wire:input="selectAllFilters('{{ $key }}')"
        {{ count($filters[$key]) === count($filter->options()) ? 'checked' : ''}}
    >
    <label class="form-check-label" for="filter-{{$key}}-select-all">@lang('All')</label>
</div>
@foreach($filter->options() as $optionKey => $value)
    <div class="form-check" wire:key="filter-{{ $key }}-multiselect-{{ $optionKey }}">
        <input
            class="form-check-input"
            onclick="event.stopPropagation();"
            type="checkbox"
            id="filter-{{$key}}-{{ $loop->index }}"
            wire:model="filters.{{$key}}"
            value="{{ $optionKey }}"
        >
        <label class="form-check-label" for="filter-{{$key}}-{{ $loop->index }}">{{ $value }}</label>
    </div>
@endforeach
