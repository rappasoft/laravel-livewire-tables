@props([
    'column',
    'sortingEnabled' => true,
    'sortable' => null,
    'direction' => null,
    'text' => null,
    'customAttributes' => [],
])

@unless ($sortingEnabled && $sortable)
    <th {{ $attributes->merge($customAttributes) }}>
        {{ $text ?? $slot }}
    </th>
@else
    <th
        wire:click="sortBy('{{ $column }}', '{{ $text ?? $column }}')"
        {{ $attributes->merge($customAttributes) }}
        style="cursor:pointer;"
    >
        <div class="d-flex align-items-center">
            <span>{{ $text }}</span>

            <span class="relative d-flex align-items-center">
                @if ($direction === 'asc')
                    <svg xmlns="http://www.w3.org/2000/svg" class="ms-1" style="width:1em;height:1em;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                    </svg>
                @elseif ($direction === 'desc')
                    <svg xmlns="http://www.w3.org/2000/svg" class="ms-1" style="width:1em;height:1em;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="ms-1" style="width:1em;height:1em;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                    </svg>
                @endif
            </span>
        </div>
    </th>
@endif
