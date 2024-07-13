---
title: DateRange Filters
weight: 3
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
            'locale' => 'en',
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
By default, this filter will inject the Flatpickr JS Library and CSS. However, you can customise this behaviour using the configuration file.

### Option 1 - The default behaviour:
```
    'inject_third_party_assets_enabled' => true,
```

### Option 2 - Bundled
If you choose to bundle the Tables JS/CSS (recommended) by adding the following to your build process:

```
'vendor/rappasoft/laravel-livewire-tables/resources/js/laravel-livewire-tables-thirdparty.min.js';
```

or in your app.js

```
import '../../vendor/rappasoft/livewire-tables/resources/js/laravel-livewire-tables-thirdparty.min.js';
```

Then you should disable injection to avoid conflicts:

```
    'inject_third_party_assets_enabled' => false,
```

#### BETA
Noting that should you require localisation, you should also include the localisation scripts in your build

```
'vendor/rappasoft/laravel-livewire-tables/resources/js/flatpickr-locales.js';
```

or in your app.js
```
import '../../vendor/rappasoft/livewire-tables/resources/js/flatpickr-locales.js';
```


### Option 3 - Locally Installed
If you have a locally installed version of Flatpickr already, you can set injection to false, and your local version will be used instead.
```
    'inject_third_party_assets_enabled' => false,
```

## Localisation (BETA)
The default installation includes only the English (en) locale.

### Bundling
Should you wish to localise, you must include the Flatpickr locale files in your build pipeline, by including the 
"vendor/rappasoft/laravel-livewire-tables/resources/js/flatpickr-locales.js" to your build process:

```
'vendor/rappasoft/laravel-livewire-tables/resources/js/flatpickr-locales.js';
```

or in your app.js
```
import '../../vendor/rappasoft/livewire-tables/resources/js/flatpickr-locales.js';
```

Or by including the specific locales that you require in your app.js (requires adding the flatpickr library to your package.json by executing "npm i flatpickr --save")
```
import { German } from "../imports/flatpickr/l10n/de.js";
```

### CDN
You can also add locales using the Flatpickr CDN, ensuring that these are loaded before the page renders.

For example to add German (de), ensure that the following is in the "head" section of your layout:
```
<script src="https://npmcdn.com/flatpickr/dist/l10n/de.js" async></script>
```