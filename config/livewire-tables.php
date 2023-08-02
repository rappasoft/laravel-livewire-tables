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
        'defaultOptions' => [ 
            'min' => '0',  
            'max' => '100',
        ], 
        'defaultConfig' => [
            'minRange' => 0, 
            'maxRange' => 100, 
            'suffix' => '',
        ],
    ],
];
