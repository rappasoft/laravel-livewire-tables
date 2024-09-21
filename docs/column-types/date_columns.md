---
title: Date Columns
weight: 9
---

Date columns provide an easy way to display dates in a given format, without having to use repetitive format() methods or partial views.

You may pass either a DateTime object, in which you can define an "outputFormat"
```php
DateColumn::make('Updated At', 'updated_at')
    ->outputFormat('Y-m-d H:i:s'),
```

Or you may pass a string, in which case you can define an "inputFormat" in addition to the outputFormat:
```php
DateColumn::make('Last Charged', 'last_charged_at')
    ->inputFormat('Y-m-d H:i:s')
    ->outputFormat('Y-m-d'),
```

You may also set an "emptyValue" to use when there is no value from the database:
```php
DateColumn::make('Last Charged', 'last_charged_at')
    ->inputFormat('Y-m-d H:i:s')
    ->outputFormat('Y-m-d')
    ->emptyValue('Not Found'),
```

Please also see the following for other available methods:
<ul>
    <li>
        <a href="https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/available-methods">Available Methods</a>
    </li>
    <li>
        <a href="https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/column-selection">Column Selection</a>
    </li>
    <li>
        <a href="https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/secondary-header">Secondary Header</a>
    </li>
    <li>
        <a href="https://rappasoft.com/docs/laravel-livewire-tables/v3/columns/footer">Footer</a>
    </li>
</ul>