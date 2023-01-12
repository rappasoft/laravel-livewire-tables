![Package Logo](https://banners.beyondco.de/Laravel%20Livewire%20Tables.png?theme=light&packageName=rappasoft%2Flaravel-livewire-tables&pattern=hideout&style=style_1&description=A+dynamic+table+component+for+Laravel+Livewire&md=1&fontSize=100px&images=table

[![Styling](https://github.com/LowerRockLabs/laravel-livewire-tables/actions/workflows/php-cs-fixer.yml/badge.svg)](https://github.com/LowerRockLabs/laravel-livewire-tables/actions/workflows/php-cs-fixer.yml)
[![Tests](https://github.com/LowerRockLabs/laravel-livewire-tables/actions/workflows/run-tests.yml/badge.svg)](https://github.com/LowerRockLabs/laravel-livewire-tables/actions/workflows/run-tests.yml)

This is a fork of the brilliant Rappsoft Laravel Livewire Tables, with the following pull requests (which are yet to be added to core)

* Updated languages to contain "All Columns"
* Add support for MorphOne relationships
* Adding option to set first option for select filter
* Fix for using SimplePagination with Bulk Actions
* Adding the capability for a SelectFilter to add a "first option" (all) when generating from a query/builder
* Adding capability for Multi select dropdown filter
* Adding an option to SlideDown filter panel to allow for "Open By Default" and "Closed by Default", Default is closed.

A dynamic Laravel Livewire component for data tables.

![Dark Mode](https://imgur.com/QoEdC7n.png)

![Full Table](https://i.imgur.com/2kfibjR.png)

### [Bootstrap 4 Demo](https://tables.laravel-boilerplate.com/bootstrap-4) | [Bootstrap 5 Demo](https://tables.laravel-boilerplate.com/bootstrap-5) | [Tailwind Demo](https://tables.laravel-boilerplate.com/tailwind) | [Demo Repository](https://github.com/rappasoft/laravel-livewire-tables-demo)

## Installation

You can install the package via composer:

``` bash
composer require rappasoft/laravel-livewire-tables
```

You must also have [Alpine.js](https://alpinejs.dev) version 3 or greater installed and available to the component.

## Documentation and Usage Instructions

See the [documentation](https://rappasoft.com/docs/laravel-livewire-tables) for detailed installation and usage instructions.

## Basic Example

```php
<?php

namespace App\Http\Livewire\Admin\User;

use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UsersTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),
            Column::make('Name')
                ->sortable(),
        ];
    }
}

```

### [See advanced example](https://rappasoft.com/docs/laravel-livewire-tables/v2/examples/advanced-example)

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please e-mail anthony@rappasoft.com to report any security vulnerabilities instead of the issue tracker.

## Credits

- [Anthony Rappa](https://github.com/rappasoft)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
