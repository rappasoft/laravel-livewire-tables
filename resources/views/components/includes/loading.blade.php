@props(['colCount' => 1])

<tr class="w-full text-center hidden h-full place-items-center align-middle" wire:loading.class.remove="hidden">
    <td  class=" place-items-center	" colspan="{{ $colCount }}">
        <div class="h-min self-center align-middle">
            <div class="lds-hourglass"></div>
            <div>Loading...</div>
        </div>
    </td>
</tr>
