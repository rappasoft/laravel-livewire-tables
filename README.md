[![Styling](https://github.com/LowerRockLabs/laravel-livewire-tables/actions/workflows/php-cs-fixer.yml/badge.svg)](https://github.com/LowerRockLabs/laravel-livewire-tables/actions/workflows/php-cs-fixer.yml)
[![Tests](https://github.com/LowerRockLabs/laravel-livewire-tables/actions/workflows/run-tests.yml/badge.svg)](https://github.com/LowerRockLabs/laravel-livewire-tables/actions/workflows/run-tests.yml)

This is a fork of the brilliant Rappsoft Laravel Livewire Tables, with the following pull requests (which are yet to be added to core)

* Fix - updated languages to contain an "All Columns" string
* Fix for Bootstrap 5
  
  [Pull Request](https://github.com/rappasoft/laravel-livewire-tables/pull/994)
* Fix for Bulk Actions Simple Pagination 
 
  [Pull Request](https://github.com/rappasoft/laravel-livewire-tables/pull/1015)
* Fix for typo in toolbar.blade.php causing toolbar-right-end to not function correctly 
 
  [Pull Request](https://github.com/rappasoft/laravel-livewire-tables/pull/1015)
* Add support for MorphOne relationships
  
  [Pull Request](https://github.com/rappasoft/laravel-livewire-tables/pull/844)
* Adding the capability to add a "first option" (all) to a SelectFilter when generating options from a query/builder 
 
  [Pull Request](https://github.com/rappasoft/laravel-livewire-tables/pull/1016)
* Adding a new filter for "select multiple" (MultiSelectDropdownFilter) 

  [Pull Request](https://github.com/rappasoft/laravel-livewire-tables/pull/1011)
* Adding an option to set the SlideDown filter panel to "Open By Default" and "Closed by Default", Default is "Closed by Default". 
 
  [Pull Request](https://github.com/rappasoft/laravel-livewire-tables/pull/1017)
* Added eagerloading so anyone can load any type of relationship when using $model (rather than builder) 

  [Pull Request](https://github.com/rappasoft/laravel-livewire-tables/pull/943)


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

## Modals

### Bulk Actions
You will need to include a view using the customView function.  This view can either contain the reference to a Livewire modal component, or just be a blade based component

Then in the relevant function for the bulkActions, you will need to retrieve the selected items, then open & populate your modal.

If you're using wire-elements/modal, then you can emit the create/open function.

```
public $selectedItems;
public $modalIsOpen = false;

public array $bulkActions = [
        'openModal' => 'Install Something'
];

public function openModal()
{
   $this->selectedItems = $this->getSelected();
   $this->modalIsOpen = true;
}
public function customView(): string
{
    return 'components.genericModal';
}
```
Then your components.genericModal blade may have something like this:
```
@if($modalIsOpen)
<div class="modal">
   @foreach($selectedItems as $selectedItem)
    <span>{{ $selectedItem }}</span><br />
  @endforeach
</div>
@endif
```
or something like this:
```
@if($modalIsOpen)
   <livewire:components.generic-modal :selectedItems="$selectedItems" />
@endif
```

**For wire-elements/modal:**
```
public array $bulkActions = [
        'openModal' => 'Install Something'
];

public function openModal()
{
   $selectedItems = $this->getSelected();
   $this->emit('openModal', "path-to-modal", ['selectedItems' => $selectedItems]);
}
```
### Buttons and wire-elements/modal
You will need to create a ButtonColumn, and emit the path to your modal, and any values that you wish to send
```
LinkColumn::make('Edit')
->title(fn($row) => 'Edit')
->location(fn($row) => '#')
->attributes(function($row) {
    return [
        'class' => 'underline text-blue-500 hover:no-underline',
        'wire:click' => '$emit(\'openModal\',\'PATHTOMODAL\', {\'id\':\''.$row->id.'\'})'
    ];
}),
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
