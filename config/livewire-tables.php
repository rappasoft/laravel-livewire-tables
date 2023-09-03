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
     * Enable or Disable automatic injection of assets
     */
    'inject_third_party_assets' => false,

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
            'pillFormat' => 'd M Y', // Used to display in the Filter Pills
        ],
    ],

    /**
     * Configuration options for DateTimeFilter
     */
    'dateTimeFilter' => [
        'defaultConfig' => [
            'format' => 'Y-m-d\TH:i',
            'pillFormat' => 'd M Y - H:i', // Used to display in the Filter Pills
        ],
    ],

    /**
     * Configuration options for DateRangeFilter
     */
    'dateRange' => [
        'defaultOptions' => [],
        'defaultConfig' => [
            'allowInput' => true,   // Allow manual input of dates
            'altFormat' => 'F j, Y', // Date format that will be displayed once selected
            'ariaDateFormat' => 'F j, Y', // An aria-friendly date format
            'dateFormat' => 'Y-m-d', // Date format that will be received by the filter
            'earliestDate' => null, // The earliest acceptable date
            'latestDate' => null, // The latest acceptable date
        ],
    ],

    /**
     * Configuration options for NumberRangeFilter
     */
    'numberRange' => [
        'defaultOptions' => [
            'min' => 0, // The default start value
            'max' => 100, // The default end value
        ],
        'defaultConfig' => [
            'minRange' => 0, // The minimum possible value
            'maxRange' => 100, // The maximum possible value
            'suffix' => '', // A suffix to append to the values when displayed
        ],
    ],

];
