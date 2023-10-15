@aware(['isTailwind', 'isBootstrap', 'tableName', 'component'])
@props(['colCount' => 1])

@php
$customAttributes['loader-wrapper'] = ['class' => 'hidden d-none', 'default' => false];
$customAttributes['loader-icon'] = $component->getLoadingPlaceHolderIconAttributes();

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
            <div class="lds-hourglass"
            {{
                    $attributes->merge($customAttributes['loader-icon'])
                        ->class(['lds-hourglass' => $isTailwind && ($customAttributes['loader-icon']['default'] ?? true)])
                        ->class(['lds-hourglass' => $isBootstrap && ($customAttributes['loader-icon']['default'] ?? true)])
                        ->except('default');
            }}
            ></div>
            <div>{{ $component->getLoadingPlaceholderContent() }}</div>
        </div>
    </td>
</tr>
