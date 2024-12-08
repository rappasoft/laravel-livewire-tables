---
title: Creating Filters
weight: 2
---

To create filters, you must implement the `filters()` method on your component, which must return an array.

```php
public function filters(): array
{
    return [];
}
```

This method will return an array of filter objects. There are a few filter types to choose from:





## Filter Keys

By default, the filter key is just the snake version of the filter name. This is used to generate the query string as well as look up the filter object in necessary places. Each filter should have a unique key.

You can override this by supplying a custom key:

```php
SelectFilter::make('Active', 'user_status')
```

Yields a query string of:

```
?table[filters][user_status]=yes
```

Instead of:

```
?table[filters][active]=yes
```

## A note about values

Your values should be strings. If you want to use a number, you should convert it to a string.

Since the frontend HTML elements treat all values as strings, it makes it easier to work with strings everywhere and convert them to integers where you need to. This is no different than submitting a form with integer values in a dropdown, they still make it to the server as strings.
