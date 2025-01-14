---
title: Column Selection
weight: 5
---

Column select is on by default. All columns are selected by default and saved in the users session.

## Excluding from Column Select

If you don't want a column to be able to be turned off from the column select box, you may exclude it:

```php
Column::make('Address', 'address.address')
    ->excludeFromColumnSelect(),
```

## Deselected by default

If you would like a column to be included in the column select but deselected by default, you can specify:

```php
Column::make('Address', 'address.address')
    ->deselected(),
```

## DeselectedIf

If you would like a column to be included in the column select but deselected based on an external parameter/callback, you may use this approach.

Returning "true" will deselect the Column by default, returning "false" will select the Column by default

```php
Column::make('Address', 'address.address')
    ->deselectedIf(fn() => 2 > 1),
```

or

```php
Column::make('Address', 'address.address')
    ->deselectedIf(!Auth::user()),
```

## SelectedIf

If you would like a column to be included in the column select and selected based on an external parameter/callback, you may use this approach.

Returning "true" will select the Column by default, returning "false" will deselect the Column by default

```php
Column::make('Address', 'address.address')
    ->selectedIf(fn() => 2 > 1),
```
or

```php
Column::make('Address', 'address.address')
    ->selectedIf(Auth::user()),
```

## Available Methods

### setColumnSelectStatus

**Enabled by default**, enable/disable column select for the component.

```php
public function configure(): void
{
    $this->setColumnSelectStatus(true);
    $this->setColumnSelectStatus(false);
}
```

### setColumnSelectEnabled

Enable column select on the component.

```php
public function configure(): void
{
    // Shorthand for $this->setColumnSelectStatus(true)
    $this->setColumnSelectEnabled();
}
```

### setColumnSelectDisabled

Disable column select on the component.

```php
public function configure(): void
{
    // Shorthand for $this->setColumnSelectStatus(false)
    $this->setColumnSelectDisabled();
}
```

### setColumnSelectHiddenOnTablet

Hide column select menu when on tablet or mobile

```php
public function configure(): void
{
    $this->setColumnSelectHiddenOnTablet();
}
```

### setColumnSelectHiddenOnMobile

Hide column select menu when on mobile.

```php
public function configure(): void
{
    $this->setColumnSelectHiddenOnMobile();
}
```


### setRememberColumnSelectionStatus

**Enabled by default**, whether or not to remember the users column select choices.

```php
public function configure(): void
{
    $this->setRememberColumnSelectionStatus(true);
    $this->setRememberColumnSelectionStatus(false);
}
```

### setRememberColumnSelectionEnabled

Remember the users column select choices.

```php
public function configure(): void
{
    // Shorthand for $this->setRememberColumnSelectionStatus(true)
    $this->setRememberColumnSelectionEnabled();
}
```

### setRememberColumnSelectionDisabled

Forget the users column select choices.

```php
public function configure(): void
{
    // Shorthand for $this->setRememberColumnSelectionStatus(false)
    $this->setRememberColumnSelectionDisabled();
}
```

### setDataTableFingerprint

In order to idenfify each table and prevent conflicts on column selection, each table is given a unique fingerprint.
This fingerprint is generated using the static::class name of the component. If you are reusing
the same component in different parts of your application, you may need to set your own custom fingerprint.

```php
public function configure(): void
{
    // Default fingerprint is output of protected method dataTableFingerprint()
    // Below will prepend the current route name
    $this->setDataTableFingerprint(route()->getName() . '-' . $this->dataTableFingerprint());
}
```

## Events

### ColumnsSelected

If using column selection, an event is triggered when a user is changing selection. This can for example be used to store the selected columns in database for the user. When the user is accessing same page with the table, read som database and set the session key to initialize selected columns.

#### Here is an example

```php
use Rappasoft\LaravelLivewireTables\Events\ColumnsSelected;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ColumnsSelected::class => [
            DataTableColumnsSelectedListener::class
        ]
    ]
}
```

```php

class DataTableColumnsSelectedListener 
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {   
        Setting::setCurrentUserTableColumns($event->key, $event->columns);     
    }

}
```

## Styling

### setColumnSelectButtonAttributes
Allows for customisation of the appearance of the "Column Select" button

Note that this utilises a refreshed approach for attributes, and allows for appending to, or replacing the styles and colors independently, via the below methods.

#### default-colors
Setting to false will disable the default colors for the Column Select button, the default colors are:

Bootstrap: None

Tailwind: `text-gray-700 bg-white border-gray-300 hover:bg-gray-50 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600`

#### default-styling
Setting to false will disable the default styling for the Column Select button, the default styling is:

Bootstrap: `btn dropdown-toggle d-block w-100 d-md-inline`

Tailwind: `inline-flex justify-center px-4 py-2 w-full text-sm font-medium rounded-md border shadow-sm focus:ring focus:ring-opacity-50`

```php
public function configure(): void
{
  $this->setColumnSelectButtonAttributes([
    'class' => 'focus:border-rose-300 focus:ring-1 focus:ring-rose-300 focus-visible:outline-rose-300', // Add these classes to the column select button
    'default-colors' => false, // Do not output the default colors
    'default-styling' => true // Output the default styling
  ]);
}
```

### setColumnSelectMenuOptionCheckboxAttributes
Allows for customisation of the appearance of the "Column Select" menu option checkbox

Note that this utilises a refreshed approach for attributes, and allows for appending to, or replacing the styles and colors independently, via the below methods.

#### default-colors
Setting to false will disable the default colors for the Column Select menu option checkbox, the default colors are:

Bootstrap: None

Tailwind: `text-indigo-600 border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600`
#### default-styling

Setting to false will disable the default styling for the Column Select menu option checkbox, the default styling is:

Bootstrap 4: None

Bootstrap 5: `form-check-input`

Tailwind: `transition duration-150 ease-in-out rounded shadow-sm focus:ring focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-wait`

```php
public function configure(): void
{
  $this->setColumnSelectMenuOptionCheckboxAttributes([
    'class' => 'text-rose-300 focus:border-rose-300 focus:ring-rose-300', // Add these classes to the column select menu option checkbox
    'default-colors' => false, // Do not output the default colors
    'default-styling' => true // Output the default styling
  ]);
}
```
