---
title: Commands
weight: 6
---

## Generating Datatable Components

To generate a new datatable component you can use the `make:datatable` command:

Create a new datatable component called `UserTable` in `App\Livewire` that uses the `App\Models\User` model.

```bash
php artisan make:datatable UserTable User
```

### Custom Model Path

You may pass a Custom Path to your model, should it not be contained within the "App" or "App\Models" namespaces:

Create a new datatable component called `TestTable` in `App\Livewire` that uses the `App\Domains\Test\Models\Example` model.

```bash
php artisan make:datatable TestTable example app/Domains/Test/Models/
```
