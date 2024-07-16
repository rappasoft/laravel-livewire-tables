---
title: Livewire Custom Filter (Beta)
weight: 11
---

**IN BETA**
This feature is currently in beta, and use in production is not recommended.

### Usage
This allows you to use a child/nested Livewire Component in place of the existing Filters, giving you more control over the look/feel/behaviour of a filter.

To use a LivewireComponentFilter, you must include it in your namespace:
```php
use Rappasoft\LaravelLivewireTables\Views\Filters\LivewireComponentFilter;
```

When creating a filter:
- Specify a unique name
- Set the path to a valid Livewire Component
- Define a filter() callback to define how the returned value will be used.

```php
    public function filters(): array
    {
        return [ 
            LivewireComponentFilter::make('My External Filter')
            ->setLivewireComponent('my-test-external-filter')
            ->filter(function (Builder $builder, string $value) {
                $builder->where('name', 'like', '%'.$value.'%');
            }),
        ];
    }
```

### Configuring Your Livewire Filter Component

A basic example (replicating the Text Filter) looks like the below, note the usage of the "IsExternalFilter" trait.
```php
<?php

namespace App\Livewire;

use Livewire\Component;
use Rappasoft\LaravelLivewireTables\Views\Traits\IsExternalFilter;

class MyTestExternalFilter extends Component
{
    use IsExternalFilter;
    
    public function render()
    {
        return view('livewire.my-test-external-filter');
    }
}
```

Should you prefer not to use the IsExternalFilter trait, the below contains all relevant code:
```php
<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Modelable;

class MyTestExternalFilter extends Component
{
    #[Modelable] 
    public $value = '';

    public $filterKey = '';
    
    public function render()
    {
        return view('livewire.my-test-external-filter');
    }
}
```


### Important Notes for Livewire Component Filter Blade
- You must update the "value" property on your component in order to return a value to the DataTableComponent.  This is setup via the "IsExternalFilter" trait.
- You should use "debounce" rather than "live" to avoid repetitive updates to the DataTableComponent

An example "my-test-external-filter.blade.php" is given below:
```php
<div role="menuitem">
    <div class="rounded-md shadow-sm" >
        <input wire:model.debounce.1000ms="value" 
            type="text" 
            id="my_test_external_filter_input" 
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
            placeholder=""
        >
    </div>
</div>
```

### Important Notes For The livewire-component-filter.blade.php
- It is **strongly** recommmended not to publish, nor update this file, while this feature is in beta, as it is subject to change at short notice, which may lead to breaking changes.