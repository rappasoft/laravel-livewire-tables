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
