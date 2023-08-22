<?php

return [
    /**
     * Options: tailwind | bootstrap-4 | bootstrap-5.
     */
    'theme' => 'tailwind',
    
    'cache_assets' => true,
    /**
     * Enable or Disable automatic injection of assets
     */
    'inject_assets' => true,

    /**
     * Enable or Disable inclusion of published third-party assets
     */
    'published_third_party_assets' => false,

    /**
     * Enable or Disable remote third-party assets
     */
    'remote_third_party_assets' => true,

    /**
     * Configuration options for DateFilter
     */
    'dateFilter' => [
        'defaultConfig' => [
            'format' => 'Y-m-d',
            'pillFormat' => 'd M Y',
        ],
    ],

    /**
     * Configuration options for DateTimeFilter
     */
    'dateTimeFilter' => [
        'defaultConfig' => [
            'format' => 'Y-m-d\TH:i',
            'pillFormat' => 'd M Y - H:i',
        ],
    ],

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

    /**
     * Configuration options for NumberRangeFilter
     */
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
