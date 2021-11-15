---
title: Installation & Configuration
weight: 1
---

**Note:** This plugin assumes you already have [Laravel Livewire 2.x](https://laravel-livewire.com) and [Alpine.js 2.x](https://github.com/alpinejs/alpine) installed and configured in your project **regardless of what theme you use**.

----

## Installation

You can install the package via composer:

``` bash
composer require rappasoft/laravel-livewire-tables
```

## Publishing Assets

Publishing assets are optional unless you want to customize this package.

----

**Note: I don't recommend you publishing the views unless you really need to change them, and if so, only keep the ones you are changing. Let the package display the rest. The views change quite often and you will miss out on new features or have unforeseeable issues.**

----

``` bash
php artisan vendor:publish --provider="Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider" --tag=livewire-tables-config

php artisan vendor:publish --provider="Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider" --tag=livewire-tables-views

php artisan vendor:publish --provider="Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider" --tag=livewire-tables-translations
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
];
```

## Tailwind Purge

If you find that Tailwind's CSS purge is removing styles that are needed, you have to tell Tailwind to look for the table styles so it knows not to purge them.

In your tailwind.config.js purge configuration:

```js
module.exports = {
    mode: 'jit',
    purge: [
        ...
        './vendor/rappasoft/laravel-livewire-tables/resources/views/tailwind/**/*.blade.php',
    ],
    ...
};
```

## Other

You must also make sure you have this Alpine style available globally:

```css
<style>
    [x-cloak] { display: none !important; }
</style>
```
