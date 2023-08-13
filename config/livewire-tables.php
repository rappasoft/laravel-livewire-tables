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

    /**
     * Enable or Disable inclusion of published third-party assets
     */
    'published_third_party_assets' => true,

    /**
     * Enable or Disable remote third-party assets
     */
    'remote_third_party_assets' => false,

    /**
     * Configuration options for NumberRangeFilter
     */
    'numberRange' => [
        'defaultOptions' => [
            'min' => 0,
            'max' => 100,
        ],
        'defaultConfig' => [
            'minRange' => 0,
            'maxRange' => 100,
            'suffix' => '',
        ],
    ],

    'dateRange' => [
        'defaultOptions' => [],
        'defaultConfig' => [
            'earliestDate' => null,
            'latestDate' => null,
            'allowInput' => true,
            'altFormat' => 'F j, Y',
            'ariaDateFormat' => 'F j, Y',
            'dateFormat' => 'Y-m-d',
        ],
    ],
];
