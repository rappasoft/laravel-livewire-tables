@aware(['component','isTailwind','isBootstrap'])

@php($attributes = $attributes->merge(['wire:key' => 'empty-message-'.$component->getId()]))

@if ($isTailwind)
    <tr {{ $attributes }}>
        <td colspan="{{ $component->getColspanCount() }}">
            <div class="flex justify-center items-center space-x-2 dark:bg-gray-800">
                <span class="font-medium py-8 text-gray-400 text-lg dark:text-white">{{ $component->getEmptyMessage() }}</span>
            </div>
        </td>
    </tr>
@elseif ($isBootstrap)
     <tr {{ $attributes }}>
        <td colspan="{{ $component->getColspanCount() }}">
            {{ $component->getEmptyMessage() }}
        </td>
    </tr>
@endif
