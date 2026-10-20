---
title: Commands
weight: 5
---

## Generating Datatable Components

To generate a new datatable component you can use the `make:datatable` command:

Create a new datatable component called `UsersTable` in `App\Livewire` that uses the `App\Models\User` model.

```bash
php artisan make:datatable UsersTable User
```

The command generates class-based components on Livewire 3 and 4. It honors `livewire.class_namespace` and, when configured, `livewire.class_path`. Nested names such as `Admin.UsersTable` create a class in the corresponding subdirectory. Existing files are preserved unless you pass `--force`.

### Custom Model Path

You may pass a Custom Path to your model, should it not be contained within the "App" or "App\Models" namespaces:

Create a new datatable component called `TestTable` in `App\Livewire` that uses the `App\Domains\Test\Models\Example` model.

```bash
php artisan make:datatable TestTable example app/Domains/Test/Models/
```

### Prompt for missing inputs

If you only use the `make:datatable` command without any arguments, it will prompt you for the missing inputs.

```bash
php artisan make:datatable
```
