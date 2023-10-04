---
title: Including Assets
weight: 3
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