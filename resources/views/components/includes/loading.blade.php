@aware(['isTailwind', 'isBootstrap', 'tableName', 'component'])
@props(['colCount' => 1])

@php
$customAttributes['loader-wrapper'] = $this->getLoadingPlaceHolderWrapperAttributes();
$customAttributes['loader-icon'] = $this->getLoadingPlaceHolderIconAttributes();
@endphp
@if($this->hasLoadingPlaceholderBlade())
    @include($this->getLoadingPlaceHolderBlade(), ['colCount' => $colCount])
@else

    <tr wire:key="{{ $tableName }}-loader"
    {{
        $attributes->merge($customAttributes['loader-wrapper'])
            ->class(['hidden w-full text-center h-screen place-items-center align-middle' => $isTailwind && ($customAttributes['loader-wrapper']['default'] ?? true)])
            ->class(['d-none w-100 text-center h-100 align-items-center' => $isBootstrap && ($customAttributes['loader-wrapper']['default'] ?? true)]);
    }}
    wire:loading.class.remove="hidden d-none"
    >
        <td colspan="{{ $colCount }}" wire:key="{{ $tableName }}-loader-column" >
            <div class="h-min self-center align-middle text-center">
                <div class="lds-hourglass"
                {{
                        $attributes->merge($customAttributes['loader-icon'])
                            ->class(['lds-hourglass' => $isTailwind && ($customAttributes['loader-icon']['default'] ?? true)])
                            ->class(['lds-hourglass' => $isBootstrap && ($customAttributes['loader-icon']['default'] ?? true)])
                            ->except(['default','default-styling','default-colors']);
                }}
                ></div>
                <div>{{ $this->getLoadingPlaceholderContent() }}</div>
            </div>
        </td>
    </tr>

@endif
