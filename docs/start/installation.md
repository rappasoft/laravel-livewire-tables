---
title: Installation
weight: 3
---

You can install the package via composer:

``` bash
composer require rappasoft/laravel-livewire-tables
```

The package supports Livewire 3 and 4. Existing class-based table components work with either version.

To upgrade an application to Livewire 4, follow the [Livewire upgrade guide](https://livewire.laravel.com/docs/4.x/upgrading), then clear the application caches:

```bash
php artisan optimize:clear
```

Search and filter blur bindings use `wire:model.live.blur` to preserve Livewire 3 behavior on Livewire 4.1 and later. If you have published package views, merge the updated bindings into your overrides. Custom bindings supplied with `setWireMethod()` are used as provided.
