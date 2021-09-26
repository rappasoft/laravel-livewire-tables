@props(['text' => null, 'customAttributes' => []])

<td {{ $attributes->merge($customAttributes) }}>
    {{ $text ?? $slot }}
</td>
