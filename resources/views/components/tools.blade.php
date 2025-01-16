@aware(['isTailwind','isBootstrap'])
@php($toolsAttributes = $this->getToolsAttributesBag())

<div {{
    $toolsAttributes->merge()
        ->class([
            'flex-col' => $isTailwind && ($toolsAttributes['default-styling'] ?? true),
            'd-flex flex-column' => $isBootstrap && ($toolsAttributes['default-styling'] ?? true)
        ])
        ->except(['default','default-styling','default-colors'])
    }}
>
    {{ $slot }}
</div>
