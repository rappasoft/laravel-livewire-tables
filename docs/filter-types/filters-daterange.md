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

A full list of options is below, please see the Flatpickr documentation for reference as to purpose:
| Config Option  | Type | Default | Description | 
| ------------- | ------------- | ------------- | ------------- |
| allowInput | Boolean | false | Allows the user to enter a date directly into the input field. By default, direct entry is disabled. | 
| altFormat | String | "F j, Y" | Exactly the same as date format, but for the altInput field | 
| altInput | Boolean | false | Show the user a readable date (as per altFormat), but return something totally different to the server. | 
| ariaDateFormat | String | "F j, Y" | Defines how the date will be formatted in the aria-label for calendar days, using the same tokens as dateFormat. If you change this, you should choose a value that will make sense if a screen reader reads it out loud. | 
| dateFormat | String | 'Y-m-d' | A string of characters which are used to define how the date will be displayed in the input box | 
| defaultDate | String | null | Sets the initial selected date | 
| defaultHour | Number | 12 | Initial value of the hour element. | 
| defaultMinute | Number | 0 | Initial value of the minute element. | 
| earliestDate | String/Date | null | The minimum date that a user can start picking from (inclusive) | 
| enableTime | Boolean | false | Enables time picker | 
| enableSeconds | Boolean | false | Enables seconds in the time picker. | 
| hourIncrement | Integer | 1 | Adjusts the step for the hour input (incl. scrolling) | 
| latestDate | String/Date | null | The maximum date that a user can pick to (inclusive) | 
| locale | String | en | The locale used (see below) | 
| minuteIncrement | Integer | 5 | Adjusts the step for the minute input (incl. scrolling) | 
| placeholder | String | null | Set a placeholder value for the input field |
| shorthandCurrentMonth | Boolean | false | Show the month using the shorthand version (ie, Sep instead of September). | 
| time_24hr | Boolean | false | Displays time picker in 24 hour mode without AM/PM selection when enabled. | 
| weekNumbers | Boolean | false | Enables display of week numbers in calendar. | 

## setFilterDefaultValue

You may use this to set a default value for the filter that will be applied on first load (but may be cleared by the user).  This should be an array:

```
    DateRangeFilter::make('EMail Verified Range')
        ->setFilterDefaultValue(['minDate' => '2024-05-05', 'maxDate' => '2024-06-06'])
```
or

```
    DateRangeFilter::make('EMail Verified Range')
        ->setFilterDefaultValue(['2024-05-05', '2024-06-06'])
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

### Option 3 - CDN
You must ensure that Flatpickr is present PRIOR to the tables loading.  For example, to add Flatpickr with the Spanish locale, ensure that the following is present in your Layout head section.  Noting the "async" presence to ensure that the script is present before a page renders.

It is typically recommended not to utilise the CDN approach, as changes to core code may impact behaviour, and you may need to implement changes to your CSP if present.

If using the CDN approach, ensure the following config matches:
```
    'inject_third_party_assets_enabled' => false,
```

Then include the following in your layout:
```
// Flatpickr Core Script
<script src="https://npmcdn.com/flatpickr" async></script>

// Flatpickr Core CSS
<link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/flatpickr.min.css">
```

### Option 4 - Locally Installed
If you have a locally installed version of Flatpickr already, you can set injection to false, and your local version will be used instead.
```
    'inject_third_party_assets_enabled' => false,
```

## Localisation (BETA)
The default installation includes only the English (en) locale.

### Bundling
Should you wish to localise, you must include the Flatpickr locale files in your build pipeline.  This applies to only the specific locales that you require in your app.js (requires adding the flatpickr library to your package.json by executing "npm i flatpickr --save")
```
import { Arabic } from "../imports/flatpickr/l10n/ar.js";
import { Catalan } from "../imports/flatpickr/l10n/cat.js";
import { Danish } from "../imports/flatpickr/l10n/da.js";
import { German } from "../imports/flatpickr/l10n/de.js";
import { Spanish } from "../imports/flatpickr/l10n/es.js";
import { French } from "../imports/flatpickr/l10n/fr.js";
import { Indonesian } from "../imports/flatpickr/l10n/id.js";
import { Italian } from "../imports/flatpickr/l10n/it.js";
import { Malaysian } from "../imports/flatpickr/l10n/ms.js";
import { Dutch } from "../imports/flatpickr/l10n/nl.js";
import { Portuguese } from "../imports/flatpickr/l10n/pt.js";
import { Russian } from "../imports/flatpickr/l10n/ru.js"
import { Thai } from "../imports/flatpickr/l10n/th.js"
import { Turkish } from "../imports/flatpickr/l10n/tr.js"
import { Ukrainian } from "../imports/flatpickr/l10n/uk.js"
```

### CDN
You can also add locales using the Flatpickr CDN, ensuring that these are loaded before the page renders.

For example to add German (de), ensure that the following is in the "head" section of your layout, ideally before your app.js
```
<script src="https://npmcdn.com/flatpickr/dist/l10n/de.js" async></script>
```