---
title: Including Assets
weight: 4
---

## Package Specific Code

This package now makes use of several external files, one for AlpineJS methods, and one for Custom Styling.  In addition, Flatpickr is separately bundled with the package, and used for the DateRange Filter.  These can be independently enabled/disabled.

### Injection (Default)
The package will automatically inject the relevant two files into your layout as part of the render process.  This is the default behaviour, and mimics that of Livewire 3.0

#### Configuration
This is enabled by default, but to re-enable, enable the following options in the livewire-tables configuration file, to enable automatic injection:

```php

    /**
     * Enable or Disable automatic injection of core assets
     */
    'inject_core_assets_enabled' => true,

    /**
     * Enable or Disable automatic injection of third-party assets
     */
    'inject_third_party_assets_enabled' => true,

```

#### Changing Script Path

You can change the path used by customising the script_base_path option in the configuration file:

```php
    /** 
     * Customise Script & Styles Paths
     */
    'script_base_path' => '/rappasoft/laravel-livewire-tables',
```

### Bundler Including
If you'd prefer to bundle the included JS and CSS files with your choice of bundler, this is provided by two files that can be included in your bundler (e.g. app.js)

#### Include Code (For Bundler)

To include only Core functions (Includes JS & CSS):
```js
import '../../vendor/rappasoft/laravel-livewire-tables/resources/imports/laravel-livewire-tables.js';
```

To include both Core and Third Party (Flatpickr) Libraries (Includes JS & CSS):
```js
import '../../vendor/rappasoft/laravel-livewire-tables/resources/imports/laravel-livewire-tables-all.js';
```

#### Configuration
Update the following options in the livewire-tables configuration file, to disable automatic injection:

```php

    /**
     * Enable or Disable automatic injection of core assets
     */
    'inject_core_assets_enabled' => false,

    /**
     * Enable or Disable automatic injection of third-party assets
     */
    'inject_third_party_assets_enabled' => false,

    /**
     * Enable Blade Directives (Not required if automatically injecting or using bundler approaches)
     */
    'enable_blade_directives ' => false,

```

### Blade Directives

There are several blade directives available, as defined below.  You only need to use these if you are not using either of the above methods.  You must ensure that you disable asset injection in the config/livewire-tables.php file, enable the blade directives, and that you have not added the scripts or styles to your bundler:
```php

    /**
     * Enable or Disable automatic injection of core assets
     */
    'inject_core_assets_enabled' => false,

    /**
     * Enable or Disable automatic injection of third-party assets
     */
    'inject_third_party_assets_enabled' => false,

    /**
     * Enable Blade Directives (Not required if automatically injecting or using bundler approaches)
     */
    'enable_blade_directives ' => true,

```

To use these in your views/blades:
```html
    <!-- Adds the Core Table Styles -->
    @rappasoftTableStyles
    
    <!-- Adds any relevant Third-Party Styles (Used for DateRangeFilter (Flatpickr) and NumberRangeFilter) -->
    @rappasoftTableThirdPartyStyles

    <!-- Adds the Core Table Scripts -->
    @rappasoftTableScripts

    <!-- Adds any relevant Third-Party Scripts (e.g. Flatpickr) -->
    @rappasoftTableThirdPartyScripts
```