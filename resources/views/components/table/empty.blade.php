@aware(['component'])

@php($attributes = $attributes->merge(['wire:key' => 'empty-message-'.$component->getId()]))
<tr {{ $attributes }} class="" wire:loading.class.add="hidden d-none">
    <td colspan="{{ $component->getColspanCount() }}" >
        @if ($component->isTailwind())
        <div class="flex justify-center items-center space-x-2 dark:bg-gray-800">
            <span class="font-medium py-8 text-gray-400 text-lg dark:text-white">
                {{ $component->getEmptyMessage() }}
            </span>
        </div>
        @elseif ($component->isBootstrap())
            {{ $component->getEmptyMessage() }}
        @endif
    </td>
</tr>
