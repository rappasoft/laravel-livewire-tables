@aware(['isTailwind','isBootstrap'])

@php($attributes = $attributes->merge(['wire:key' => 'empty-message-'.$this->getId()]))

<tr {{ $attributes }}>
    <td colspan="{{ $this->getColspanCount() }}">
        @if ($isTailwind)
            <div class="flex justify-center items-center space-x-2 dark:bg-gray-800">
                <span class="font-medium py-8 text-gray-400 text-lg dark:text-white">{{ $this->getEmptyMessage() }}</span>
            </div>
        @else
            {{ $this->getEmptyMessage() }}

        @endif
    </td>
</tr>
