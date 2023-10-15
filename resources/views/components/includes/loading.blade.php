@aware(['isTailwind', 'isBootstrap', 'tableName', 'component'])
@props(['colCount' => 1])

@php
$customAttributes['loader-wrapper'] = ['class' => 'hidden d-none', 'default' => false];
@endphp
<tr
{{
    $attributes->merge($customAttributes['loader-wrapper'])
        ->class(['w-full text-center  h-screen place-items-center align-middle' => $isTailwind])
        ->class(['w-100 text-center  h-100 align-items-center' => $isBootstrap])
        ->except('default');
}}
wire:key="{{ $tableName }}-loader" wire:loading.class.remove="hidden"

 >
    <td colspan="{{ $colCount }}">
        <div class="h-min self-center align-middle text-center">
            <div 
            {{
                    $attributes->merge($component->getLoadingPlaceHolderIconAttributes())
                        ->class(['lds-hourglass' => $isTailwind])
                        ->class(['lds-hourglass' => $isBootstrap])
                        ->except('default');
            }}
            ></div>
            <div>{{ $component->getLoadingPlaceholderContent() }}</div>
        </div>
    </td>
</tr>
