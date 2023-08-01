<?php

return [
    /**
     * Options: tailwind | bootstrap-4 | bootstrap-5.
     */
    'theme' => 'tailwind',

    /**
     * Enable or Disable automatic injection of assets
     */
    'inject_assets' => true,


    'numberRange' => [
        'defaults' => [
            'min' => '0', // A Default Minimum Value
            'max' => '100',  // A Default Maximum Value
        ],
        'minRange' => 0, // A Default Minimum Permitted Value
        'maxRange' => 100,  // A Default Minimum Permitted Value
        'suffix' => '', // A Default Suffix
        'styling' => [
            'light' => [ // Used When "dark" class is not in a parent element
                'activeColor' => '#FFFFFF', // Color of the text within the circle when hovered
                'fillColor' => '#0366d6', // The color of the bar for the selected range
                'primaryColor' => '#0366d6', // The primary color
                'progressBackground' => '#eee', // The color of the remainder of the bar
                'thumbColor' => '#FFFFFF', // The color of the Circle
                'ticksColor' => 'silver',
                'valueBg' => 'transparent',
                'valueBgHover' => '#0366d6', // The bg color of the current value when the relevant selector is hovered over
            ],
            'dark' => [ // Used When "dark" class is in a parent element
                'activeColor' => 'transparent',
                'fillColor' => '#000000', // The color of the bar for the selected range
                'progressBackground' => '#909090', // The color of the remainder of the bar
                'primaryColor' => '#000000', // The primary color
                'thumbColor' => '#000066', // The color of the Circle
                'ticksColor' => '#000000', // The color of the vertical lines at the end of the bar
                'valueBg' => '#000000',
                'valueBgHover' => '#000066', // The bg color of the current value when the relevant selector is hovered over
            ],
        ],
    ],
];
