---
title: Hiding The Table (beta)
weight: 8
---

You may wish to hide the table on load.  To do so, you should use the following in the mount method.  Note that this is in mount, not boot nor configure!

```php
    public function mount()
    {
        $this->setShouldBeHidden();
    }
```

### Using Events To Display/Hide

For example, you may have a "Sales" table that you wish to hide by default: 
```php
class SalesTable extends DataTableComponent
{
    public string $tableName = 'sales'; // Required to keep the call specific

    public function mount()
    {
        $this->setShouldBeHidden(); // Defaults the table to be hidden, note that this is in MOUNT and not CONFIGURE
    }

    // Configure/Columns/Filters etc
}
```

The Table allows for different approaches, out-of-the-box it supports the more efficient client-side listeners.

However - should you wish to use Livewire listeners in your table component, for example if you wish to pass more detail into the Table then you can:

```php
    #[On('showTable.{tableName}')] 
    public function showTable(): void
    {
        $this->setShouldBeDisplayed();
    }

    #[On('hideTable.{tableName}')] 
    public function hideTable(): void
    {
        $this->setShouldBeHidden();
    }
```


### Secondary Table
Below are the two approaches.  Note that you can customise the Livewire "On" to pass additional details should you wish.

#### Using Client Side Listeners
```php
    Column::make('Show')
        ->label(
            fn($row, Column $column) => "<button x-on:click=\"\$dispatch('show-table',{'tableName': 'sales' })\">Show Sales Table</button>"
        )->html(),
    Column::make('Hide')
        ->label(
            fn($row, Column $column) => "<button x-on:click=\"\$dispatch('hide-table',{'tableName': 'sales' })\">Hide Sales Table</button>"
        )->html(),
```


#### Using Livewire "On" Style Listeners:
```php
    Column::make('Show')
    ->label(
        fn($row, Column $column) => "<button x-on:click=\"\$dispatch('showTable.sales')\">Show Sales Table</button>"
    )->html(),
    Column::make('Hide')
    ->label(
        fn($row, Column $column) => "<button x-on:click=\"\$dispatch('hideTable.sales')\">Hide Sales Table</button>"
    )->html(),

```