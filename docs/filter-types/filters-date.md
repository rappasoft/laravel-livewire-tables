---
title: Date Filters
weight: 2
---

## Date Filters

Date filters are HTML date elements.

```php
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;

public function filters(): array
{
    return [
        DateFilter::make('Verified From'),
    ];
}
```

Date filters have configs to set min and max, to set the format for the Filter Pills, and to set a placeholder value

```php
public function filters(): array
{
    return [
        DateFilter::make('Verified From')
            ->config([
                'min' => '2020-01-01',  // Earliest Acceptable Date
                'max' => '2021-12-31', // Latest Acceptable Date
                'pillFormat' => 'd M Y', // Format for use in Filter Pills
                'placeholder' => 'Enter Date', // A placeholder value
            ])
    ];
}
```

Date filters also support the setFilterDefaultValue() method, which must be a valid date in the "Y-m-d" format.  This will apply as a default until removed.
```php
public function filters(): array
{
    return [
        DateFilter::make('Verified From')
            ->config([
                'min' => '2020-01-01',
                'max' => '2023-12-31',
                'pillFormat' => 'd M Y',
            ])->setFilterDefaultValue('2023-08-01')
    ];
}
```
                    

