@foreach($filter->options() as $k => $value)
    <div class="form-check">
        <input
            class="form-check-input"
            onclick="event.stopPropagation();"
            type="checkbox"
            id="filter-{{$key}}-{{ $loop->index }}"
            wire:model="filters.{{$key}}.{{ $loop->index }}"
            value="{{ $k }}"
        >
        <label class="form-check-label" for="filter-{{$key}}-{{ $loop->index }}">{{ $value }}</label>
    </div>
@endforeach
