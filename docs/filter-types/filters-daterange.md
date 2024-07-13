---
title: DateRange Filters
weight: 3
---

DateRange filters are Flatpickr based components, and simply filtering by a date range.  If you would like to more smoothly filter your query by a start and end date, you can use the DateRangeFilter:

```php
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;

public function filters(): array
{
    return [
        DateRangeFilter::make('Verified Period'),
    ];
}
```

DateRange filters have configs to set earliestDate and latestDate, to allow/disallow input, to set the input format, to set a placeholder value,  display format, plus Filter Pills labels

```php
public function filters(): array
{
    return [
        DateRangeFilter::make('EMail Verified Range')
        ->config([
            'allowInput' => true,   // Allow manual input of dates
            'altFormat' => 'F j, Y', // Date format that will be displayed once selected
            'ariaDateFormat' => 'F j, Y', // An aria-friendly date format
            'dateFormat' => 'Y-m-d', // Date format that will be received by the filter
            'earliestDate' => '2020-01-01', // The earliest acceptable date
            'latestDate' => '2023-08-01', // The latest acceptable date
            'placeholder' => 'Enter Date Range', // A placeholder value
        ])
        ->setFilterPillValues([0 => 'minDate', 1 => 'maxDate']) // The values that will be displayed for the Min/Max Date Values
        ->filter(function (Builder $builder, array $dateRange) { // Expects an array.
            $builder
                ->whereDate('users.email_verified_at', '>=', $dateRange['minDate']) // minDate is the start date selected
                ->whereDate('users.email_verified_at', '<=', $dateRange['maxDate']); // maxDate is the end date selected
        }),
    ];
}
```



## Configuration
By default, this filter will use a CDN to include the Flatpickr JS Library and CSS. However, you can customise this behaviour using the configuration file.

### Option 1 - The default CDN behaviour:
```
    'published_third_party_assets' => false,
    'remote_third_party_assets' => true,
```

### Option 2 - Publish included version
You may publish the included version of Flatpickr.  To do so, run:
```
php artisan vendor:publish --tag=livewire-tables-public
```
This will publish the tested version of Flatpickr to your public directory. You should then set
```
    'published_third_party_assets' => true,
    'remote_third_party_assets' => false,
```

### Option 3 - Locally Installed
If you have a locally installed version of Flatpickr already, you can set both options to false, and your local version will be used instead.
```
    'published_third_party_assets' => false,
    'remote_third_party_assets' => false,
```
