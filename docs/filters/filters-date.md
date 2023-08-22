---
title: Date Filters
weight: 6
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

Date filters have configs to set min and max, and to set the format for the Filter Pills

```php
public function filters(): array
{
    return [
        DateFilter::make('Verified From')
            ->config([
                'min' => '2020-01-01',
                'max' => '2021-12-31',
                'pillFormat' => 'd M Y',
            ])
    ];
}
```
