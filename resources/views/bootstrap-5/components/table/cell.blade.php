@props(['customAttributes' => []])

<td {{ $attributes->merge($customAttributes) }}>
    {{ $slot }}
</td>
