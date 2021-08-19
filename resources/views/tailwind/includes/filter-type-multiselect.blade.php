<div class="mt-1 relative rounded-md">
{{--    We're not using a select element, but for UX, we choose checkboxes--}}
{{--    <select--}}
{{--        wire:model.stop="filters.{{ $key }}"--}}
{{--        wire:key="filter-{{ $key }}"--}}
{{--        id="filter-{{ $key }}"--}}
{{--        class="rounded-md shadow-sm block w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:border-indigo-300 focus:shadow-outline-indigo sm:text-sm sm:leading-5"--}}
{{--        multiple="multiple"--}}
{{--    >--}}
{{--        @foreach($filter->options() as $key => $value)--}}
{{--            <option value="{{ $key }}">{{ $value }}</option>--}}
{{--        @endforeach--}}
{{--    </select>--}}

    @foreach($filter->options() as $optionKey => $value)
        <input
            type="checkbox"
            id="filter-{{$key}}-{{ $loop->index }}"
            wire:key="filter-{{$key}}-{{ $loop->index }}"
            wire:model.stop="filters.{{$key}}.{{ $loop->index }}"
            value="{{ $optionKey }}"
        >
        <label for="filter-{{$key}}-{{ $loop->index }}">{{ $value }}</label>
        <br>
    @endforeach
</div>
