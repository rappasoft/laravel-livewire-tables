<div @class([
                'items-center content-center place-content-center place-items-center',
            ])
>
    <div {{ $attributeBag->class(['h-6 w-6 rounded-md self-center' => $attributeBag['default'] ?? (empty($attributeBag['class']) || (!empty($attributeBag['class']) && ($attributeBag['default'] ?? false)))]) }}
        @style([
            "background-color: {$color}" => $color,
        ])
    >
    </div>
</div>
