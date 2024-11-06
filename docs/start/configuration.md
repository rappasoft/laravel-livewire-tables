---
title: Configuration
weight: 5
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

You must also make sure you have this Alpine style available globally. Note that this is configured by default by Livewire after 3.x

```css
<style>
    [x-cloak] { display: none !important; }
</style>
```

## Bypassing Laravel's Auth Service

By default, all [events](../datatable/events#dispatched) will retrieve any currently authenticated user from Laravel's [Auth service](https://laravel.com/docs/authentication) and pass it along with the event.

If your project doesn't include the Illuminate/Auth package, or you otherwise want to prevent this, you can set the `enableUserForEvent` config option to false.

```php
// config/livewire-tables.php
return [
    // ...
    'events' => [
        /**
        * Enable or disable passing the user from Laravel's Auth service to events
        */
        'enableUserForEvent' => false,
    ],
];
```
