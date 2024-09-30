---
title: Available Methods
weight: 1
---

These are the available configuration methods for pagination.

---

## setPageName

Set the page name for the component's pagination, defaults to `page`.

```php
public function configure(): void
{
    $this->setPageName('users');
}
```

---

## setPaginationStatus

**Enabled by default**, enable/disable pagination for the component.

```php
public function configure(): void
{
    $this->setPaginationStatus(true);
    $this->setPaginationStatus(false);
}
```

## setPaginationEnabled

Enable pagination for the component.

```php
public function configure(): void
{
    // Shorthand for $this->setPaginationStatus(true);
    $this->setPaginationEnabled();
}
```

## setPaginationDisabled

Disable pagination for the component.

```php
public function configure(): void
{
    // Shorthand for $this->setPaginationStatus(false);
    $this->setPaginationDisabled();
}
```

---

## setPaginationVisibilityStatus

**Enabled by default**, enable/disable pagination visibility.

```php
public function configure(): void
{
    $this->setPaginationVisibilityStatus(true);
    $this->setPaginationVisibilityStatus(false);
}
```

## setPaginationVisibilityEnabled

Enable pagination visibility.

```php
public function configure(): void
{
    // Shorthand for $this->setPaginationVisibilityStatus(true);
    $this->setPaginationVisibilityEnabled();
}
```

## setPaginationVisibilityDisabled

Disable pagination visibility.

```php
public function configure(): void
{
    // Shorthand for $this->setPaginationVisibilityStatus(false);
    $this->setPaginationVisibilityDisabled();
}
```

---

## setPerPageVisibilityStatus

**Enabled by default**, enable/disable per page visibility.

```php
public function configure(): void
{
    $this->setPerPageVisibilityStatus(true);
    $this->setPerPageVisibilityStatus(false);
}
```

## setPerPageVisibilityEnabled

Enable per page visibility.

```php
public function configure(): void
{
    // Shorthand for $this->setPerPageVisibilityStatus(true);
    $this->setPerPageVisibilityEnabled();
}
```

## setPerPageVisibilityDisabled

Disable per page visibility.

```php
public function configure(): void
{
    // Shorthand for $this->setPerPageVisibilityStatus(false);
    $this->setPerPageVisibilityDisabled();
}
```

---

## setPerPageAccepted

Set the accepted values for the per page dropdown. Defaults to `[10, 25, 50]`

```php
public function configure(): void
{
    $this->setPerPageAccepted([10, 25, 50, 100]);
}
```

**Note:** Set an option of `-1` to enable `All`.

## setPerPage

Set the selected option of the per page dropdown.

```php
public function configure(): void
{
    $this->setPerPage(10);
}
```

## setDefaultPerPage

Set the default selected option of the per-page dropdown, will be over-ridden if set at Session or QueryString level.

```php
public function configure(): void
{
    $this->setDefaultPerPage(10);
}
```

**Note:** The value set must be included in the `per page accepted` values.

## setPaginationMethod

Set the pagination method. By default, the table will use the `paginate` method.

You may specify `simplePaginate` like so:

```php
public function configure(): void
{
    $this->setPaginationMethod('simple');
}
```

You may specify `cursorPaginate` like so:

```php
public function configure(): void
{
    $this->setPaginationMethod('cursor');
}
```

## getPerPageDisplayedItemIds

Returns the Primary Key for the currently visible rows in an array.  This should be used in a blade to ensure accuracy.

```php
    $this->getPerPageDisplayedItemIds();
```

## getPerPageDisplayedItemCount

Returns the number of rows that are currently displayed.  This should be used in a blade to ensure accuracy.

```php
    $this->getPerPageDisplayedItemCount();
```

## setDisplayPaginationDetailsEnabled
Enables display of Pagination Details (e.g. Displaying Rows x of y) - default behaviour

```php
public function configure(): void
{
    $this->setDisplayPaginationDetailsEnabled();
}
```

## setDisplayPaginationDetailsDisabled
Disables display of Pagination Details (e.g. Displaying Rows x of y)

```php
public function configure(): void
{
    $this->setDisplayPaginationDetailsDisabled();
}
```

## setPerPageFieldAttributes
Allows for customisation of the appearance of the "Per Page" dropdown

Note that this utilises a refreshed approach for attributes, and allows for appending to, or replacing the styles and colors independently, via the below methods.

### default-colors
Setting to false will disable the default colors for the Per Page dropdown, the default colors are:
Bootstrap: 
None

Tailwind: 
border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600

### default-styling
Setting to false will disable the default styling for the Per Page dropdown, the default styling is:
Bootstrap 4:
form-control

Bootstrap 5:
form-select

Tailwind:
block w-full rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:ring focus:ring-opacity-50

```php
public function configure(): void
{
    $this->setPerPageFieldAttributes([
        'class' => 'border-red-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-red-700 dark:text-white dark:border-red-600', // Add these classes to the dropdown
        'default-colors' => false, // Do not output the default colors
        'default-styles' => true, // Output the default styling
    ]);
}
```

## setShouldRetrieveTotalItemCountStatus

Used when "simple" pagination is being used, allows the enabling/disabling of the "total records" count.  This may be desirable to disable in larger data sets.  This is enabled by default.

```php
public function configure(): void
{
    $this->setShouldRetrieveTotalItemCountStatus(false);
}
```

## setShouldRetrieveTotalItemCountEnabled

Used when "simple" pagination is being used, enables the "total records" count.

```php
public function configure(): void
{
    $this->setShouldRetrieveTotalItemCountEnabled();
}
```

## setShouldRetrieveTotalItemCountDisabled

Used when "simple" pagination is being used, disables the "total records" count.

```php
public function configure(): void
{
    $this->setShouldRetrieveTotalItemCountDisabled();
}
```

## setPaginationWrapperAttributes

Used to set attributes for the "div" that wraps the pagination section

```php
public function configure(): void
{
    $this->setPaginationWrapperAttributes(['class' => 'text-lg']);
}
```
