---
title: DateRange Filters
weight: 7
---

## DateRange Filters

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
