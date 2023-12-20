<div @class([
                'items-center content-center place-content-center place-items-center' => $isTailwind,
                'p-4' => !$isTailwind
            ])
>
    <div {{ $attributeBag->class([
            'h-6 w-6 rounded-md self-center' => $isTailwind && ($attributeBag['default'] ?? (empty($attributeBag['class']) || (!empty($attributeBag['class']) && ($attributeBag['default'] ?? false)))),
            'w-100 p-4 mb-4' => !$isTailwind && ($attributeBag['default'] ?? (empty($attributeBag['class']) || (!empty($attributeBag['class']) && ($attributeBag['default'] ?? false)))),
        ]) }}
        @style([
            "background-color: {$color}" => $color,
        ])
    >
    </div>
</div>
