---
title: Validation
weight: 5
---

## Filter Validation

The filters have return types defined within the built-in validation methods to ensure that the data type is returned is functional, these are listed below (see Built-In Validation Return Types) for reference.

By default, the validation that takes place is to ensure that the Filter Value will meet the expected return type.  If a value does not meet this criteria, "false" is returned instead, the filter value is cleared, and *will not apply*.

### Enabling Validation
To enable default validation on a Filter, you may call:
```php
    TextFilter::make('Success No')
    ->setValidationEnabled(),
```

### Disabling Validation
To disable default validation on a Filter, you may call:
```php
    TextFilter::make('Success No')
    ->setValidationDisabled(),
```

### Custom Validation Callback
You can also use a custom validation method, in which case you may use the "validation()" method on the Filter to define a custom validation callback.

You may choose to either supplement, or override the default validation methods.
To override the internal validation, Disable Validation on the filter.
To supplement the internal validation, Enable Validation (enabled by default).  Note that the internal validation will run first.

```php
    TextFilter::make('Success No')
    ->validation(function ($value) { return $value == 'test' ? $value : false;}),
```

### Built-In Validation Return Types

Below are the return types defined for each Filter, for reference.

```php
DateFilter string|bool
DateRangeFilter array|bool
DateTimeFilter string|bool
MultiSelectDropdownFilter array|int|string|bool
MultiSelectFitler array|int|string|bool
NumberFilter int|bool
NumberRangeFilter array|bool
SelectFilter array|string|bool
TextFilter string|bool
```
