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