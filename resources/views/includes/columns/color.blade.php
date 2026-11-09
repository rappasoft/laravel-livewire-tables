<div @class([
                'items-center content-center place-content-center place-items-center' => $isTailwind,
            ])
>
    <div {{ $attributeBag->class([
            'h-6 w-6 rounded-md self-center' => $isTailwind && ($attributeBag['default'] ?? (empty($attributeBag['class']) || (!empty($attributeBag['class']) && ($attributeBag['default'] ?? false)))),
            
        ]) }}
        @style([
            "background-color: ".e($color) => $color,
        ])
    >
    </div>
</div>
