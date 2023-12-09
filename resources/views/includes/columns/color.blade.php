<div @class([
                'items-center content-center place-content-center place-items-center',
            ])
>
    <div 
        @class([
             $customClasses['class'] => !empty($customClasses['class']),
            'h-6 w-6 rounded-md self-center' => $customClasses['default'] ?? false,
        ])
        @style([
            "background-color: {$color}" => $color,
        ])
    >
    </div>
</div>
