---
title: Configuration
weight: 3
---

## Publishing Assets

Publishing assets are optional unless you want to customize this package.

**Note: I don't recommend you publishing the views unless you really need to change them, and if so, only keep the ones you are changing. Let the package display the rest. The views change quite often and you will miss out on new features or have unforeseeable issues.**

```bash
php artisan vendor:publish --provider="Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider" --tag=livewire-tables-config

php artisan vendor:publish --provider="Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider" --tag=livewire-tables-views

php artisan vendor:publish --provider="Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider" --tag=livewire-tables-translations

php artisan vendor:publish --provider="Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider" --tag=livewire-tables-public

```

The default frontend framework is Tailwind, but you also have the option to use Bootstrap 4 or Bootstrap 5 by specifying in the config file.

This is the contents of the published config file:

```php
<?php

return [
    /**
     * Options: tailwind | bootstrap-4 | bootstrap-5.
     */
    'theme' => 'tailwind',

    /** Enable or Disable caching of assets
     * 
     */
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
            'format' => 'Y-m-d', // Used when passing a string to the DateFilter
            'pillFormat' => 'd M Y', // Used to display in the Filter Pills
        ],
    ],

    /**
     * Configuration options for DateTimeFilter
     */
    'dateTimeFilter' => [
        'defaultConfig' => [
            'format' => 'Y-m-d\TH:i', // Used when passing a string to the DateFilter
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

```

## Tailwind Purge

If you find that Tailwind's CSS purge is removing styles that are needed, you have to tell Tailwind to look for the table styles so it knows not to purge them.

In your tailwind.config.js configuration:

```js
// V2
module.exports = {
    mode: 'jit',
    purge: [
        ...
        './vendor/rappasoft/laravel-livewire-tables/resources/views/**/*.blade.php',
    ],
    ...
};

// V3
module.exports = {
    content: [
        ...
        './vendor/rappasoft/laravel-livewire-tables/resources/views/**/*.blade.php',
    ],
    ...
};
```

## Tailwind Dark Mode
If you find that the table is consistently displaying in Dark Mode, then you will need to add the following into your tailwind.config.js configuration, keeping in mind that this **could** impact other components using dark mode! 

```js
module.exports = {
    darkMode: 'class', // This specifies that Tailwind should look at Class elements to determine dark mode
...
};
```

## Alpine.js Cloak

This is configured by default by Livewire after 3.x.

## Package Specific Code

This package makes use of both external JS and external CSS files.  These are used for core functionality of both the Table Component, and some Filters.  To include these, there are two options available to you.  In addition, please ensure to read the related "Optional Packages" article

### Core Injection (Default)
The package will automatically inject the relevant files into your layout as part of the render process.  This is the default behaviour, and mimics that of Livewire 3.0
To use this approach, you should set the following in your configuration file:
```
    'inject_assets' => true,
```

### Build Include
If you wish to disable the injection, you may include the following file in your app.js, which will provide the relevant functionality and styling for the package to function.

#### With Third Party Libraries
Includes required libraries (including Flatpickr)
```
import '../../vendor/rappasoft/laravel-livewire-tables/resources/laravel-livewire-tables-with-tp.js';
```

#### Without Third Party Libraries
```
import '../../vendor/rappasoft/laravel-livewire-tables/resources/laravel-livewire-tables.js';
```

