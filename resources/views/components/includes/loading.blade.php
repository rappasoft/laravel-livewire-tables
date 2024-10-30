@aware(['tableName'])
@props(['colCount' => 1])

@php
$loaderRow = $this->getLoadingPlaceHolderRowAttributes();
$loaderCell = $this->getLoadingPlaceHolderCellAttributes();
$loaderIcon = $this->getLoadingPlaceHolderIconAttributes();
@endphp

<tr wire:key="{{ $tableName }}-loader" wire:loading.class.remove="hidden d-none" {{
    $attributes->merge($loaderRow)
        ->class(['hidden w-full text-center place-items-center align-middle' => $this->isTailwind && ($loaderRow['default'] ?? true)])
        ->class(['d-none w-100 text-center align-items-center' => $this->isBootstrap && ($loaderRow['default'] ?? true)])
        ->except(['default','default-styling','default-colors'])
}}>
    <td colspan="{{ $colCount }}" wire:key="{{ $tableName }}-loader-column" {{
        $attributes->merge($loaderCell)
            ->class(['py-4' => $this->isTailwind && ($loaderCell['default'] ?? true)])
            ->class(['py-4' => $this->isBootstrap && ($loaderCell['default'] ?? true)])
            ->except(['default','default-styling','default-colors', 'colspan','wire:key'])
    }}>
        @if($this->hasLoadingPlaceholderBlade())
            @include($this->getLoadingPlaceHolderBlade(), ['colCount' => $colCount])
        @else
            <div class="h-min self-center align-middle text-center">
                <div class="lds-hourglass"{{
                        $attributes->merge($loaderIcon)
                            ->class(['lds-hourglass' => $this->isTailwind && ($loaderIcon['default'] ?? true)])
                            ->class(['lds-hourglass' => $this->isBootstrap && ($loaderIcon['default'] ?? true)])
                            ->except(['default','default-styling','default-colors']);
                }}></div>
                <div>{!! $this->getLoadingPlaceholderContent() !!}</div>
            </div>
        @endif
    </td>
</tr>

