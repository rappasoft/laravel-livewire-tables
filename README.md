![Package Logo](https://banners.beyondco.de/Laravel%20Livewire%20Tables.png?theme=light&packageName=rappasoft%2Flaravel-livewire-tables&pattern=hideout&style=style_1&description=A+dynamic+table+component+for+Laravel+Livewire&md=1&fontSize=100px&images=table)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rappasoft/laravel-livewire-tables.svg?style=flat-square)](https://packagist.org/packages/rappasoft/laravel-livewire-tables)
[![Styling](https://github.com/rappasoft/laravel-livewire-tables/actions/workflows/php-cs-fixer.yml/badge.svg)](https://github.com/rappasoft/laravel-livewire-tables/actions/workflows/php-cs-fixer.yml)
[![Tests](https://github.com/rappasoft/laravel-livewire-tables/actions/workflows/run-tests.yml/badge.svg)](https://github.com/rappasoft/laravel-livewire-tables/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/rappasoft/laravel-livewire-tables.svg?style=flat-square)](https://packagist.org/packages/rappasoft/laravel-livewire-tables)

A dynamic Laravel Livewire component for data tables.

![Dark Mode](https://imgur.com/QoEdC7n.png)

![Full Table](https://i.imgur.com/2kfibjR.png)

### [Bootstrap 4 Demo](https://tables.laravel-boilerplate.com/bootstrap-4) | [Bootstrap 5 Demo](https://tables.laravel-boilerplate.com/bootstrap-5) | [Tailwind Demo](https://tables.laravel-boilerplate.com/tailwind)

## Installation

You can install the package via composer:

``` bash
composer require rappasoft/laravel-livewire-tables
```

Please see the rest of the [installation instructions](https://github.com/rappasoft/laravel-livewire-tables/wiki/Installation-&-Configuration).

## Usage

### [Read the documentation](https://rappasoft.github.io/laravel-livewire-tables-docs/)

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

    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('E-mail', 'email')
                ->sortable()
                ->searchable(),
            Column::make('Verified', 'email_verified_at')
                ->sortable(),
        ];
    }

    public function query(): Builder
    {
        return User::query();
    }
}
```

### [See advanced example](https://github.com/rappasoft/laravel-livewire-tables/wiki/Advanced-Example-Table)

## To-do/Roadmap

- [x] Bootstrap 4 Template
- [x] Bootstrap 5 Template
- [x] Sorting By Relationships
- [x] User Column Selection  
- [x] Drag & Drop (beta)
- [ ] Collection/Query Support  
- [ ] Test Suite (WIP)
- [ ] Column Search
- [ ] Greater Configurability

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
