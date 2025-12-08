---
title: Available Methods
weight: 1
---

These are the available configuration methods on the datatable component.

## General

### setPrimaryKey

Set the primary key column of the component.

```php
public function configure(): void
{
  $this->setPrimaryKey('id');
}
```

### heading

Set a heading for the table.

```php
public function configure(): void
{
  $this->setPrimaryKey('id')
      ->heading('Users');
}
```

### description

Set a description for the table that appears below the heading.

```php
public function configure(): void
{
  $this->setPrimaryKey('id')
      ->heading('Users')
      ->description('Manage your users here.');
}
```

### header

Set a custom header view for the table.

```php
public function configure(): void
{
  $this->setPrimaryKey('id')
      ->header(view('tables.header', [
          'heading' => 'Users',
      ]));
}
```

### useComputedPropertiesDisabled

If you have published the Views **prior to v3.4.5**, and do not wish to remove the published views, then you should add the following call, which will disable the new Computed Properties behaviour.  Note that publishing the views is not recommended!

```php
public function configure(): void
{
  $this->useComputedPropertiesDisabled();
}
```


## Attributes

Documentation for Data Table Styling/Attributes is now: [Here](../datatable/styling)

## Offline

Offline indicator is **enabled by default**, but if you ever needed to toggle it you can use the following methods:

Enable/disable the offline indicator.

### setOfflineIndicatorStatus

```php
public function configure(): void
{
  $this->setOfflineIndicatorStatus(true);
  $this->setOfflineIndicatorStatus(false);
}
```

### setOfflineIndicatorEnabled

Enable the offline indicator.

```php
public function configure(): void
{
  // Shorthand for $this->setOfflineIndicatorStatus(true)
  $this->setOfflineIndicatorEnabled();
}
```

### setOfflineIndicatorDisabled

Disable the offline indicator.

```php
public function configure(): void
{
  // Shorthand for $this->setOfflineIndicatorStatus(false)
  $this->setOfflineIndicatorDisabled();
}
```

## Query String

The query string is **enabled by default**, but if you ever needed to toggle it you can use the following methods:

### setQueryStringStatus

Enable/disable the query string.

```php
public function configure(): void
{
  $this->setQueryStringStatus(true);
  $this->setQueryStringStatus(false);
}
```

### setQueryStringEnabled

Enable the query string.

```php
public function configure(): void
{
  // Shorthand for $this->setQueryStringStatus(true)
  $this->setQueryStringEnabled();
}
```

### setQueryStringDisabled

Disable the query string.

```php
public function configure(): void
{
  // Shorthand for $this->setQueryStringStatus(false)
  $this->setQueryStringDisabled();
}
```

## Relationships

**Disabled by default**, enable to eager load relationships for all columns in the component.

### setEagerLoadAllRelationsStatus

Enable/disable column relationship eager loading.

```php
public function configure(): void
{
  $this->setEagerLoadAllRelationsStatus(true);
  $this->setEagerLoadAllRelationsStatus(false);
}
```

### setEagerLoadAllRelationsEnabled

Enable column relationship eager loading.

```php
public function configure(): void
{
  // Shorthand for $this->setEagerLoadAllRelationsStatus(true)
  $this->setEagerLoadAllRelationsEnabled();
}
```

### setEagerLoadAllRelationsDisabled

Disable column relationship eager loading.

```php
public function configure(): void
{
  // Shorthand for $this->setEagerLoadAllRelationsStatus(false)
  $this->setEagerLoadAllRelationsDisabled();
}
```

## Builder

### setAdditionalSelects

By default the only columns defined in the select statement are the ones defined via columns. If you need to define additional selects that you don't have a column for you may:

Note - that you may only call this once, and it will override any existing additionalSelects in use.

```php
public function configure(): void
{
  $this->setAdditionalSelects(['users.id as id']);
}
```

Since you probably won't have an `ID` column defined, the ID will not be available on the model to use. In the case of an actions column where you have buttons specific to the row, you probably need that, so you can add the select statement to make it available on the model.

### addAdditionalSelects

By default the only columns defined in the select statement are the ones defined via columns. If you need to define additional selects that you don't have a column for you may:

Note - that in contrast to setAdditionalSelects, you may call this multipole times, and it will append the additional selects.  Take care not to re-use the same field names!

```php
public function configure(): void
{
  $this->addAdditionalSelects(['users.id as id']);
}
```

## Misc.

### setEmptyMessage

Set the message displayed when the table is filtered but there are no results to show.

Defaults to: "_No items found. Try to broaden your search._"

```php
public function configure(): void
{
  $this->setEmptyMessage('No results found');
}
```

### emptyState

Set a custom empty state view.

```php
public function configure(): void
{
  $this->setPrimaryKey('id')
      ->emptyState(view('tables.empty-state'));
}
```

### emptyStateHeading

Set a custom heading for the empty state.

```php
public function configure(): void
{
  $this->setPrimaryKey('id')
      ->emptyStateHeading('No users found');
}
```

### emptyStateDescription

Set a custom description for the empty state.

```php
public function configure(): void
{
  $this->setPrimaryKey('id')
      ->emptyStateHeading('No users found')
      ->emptyStateDescription('Get started by creating a new user.');
}
```

### recordClasses

Set CSS classes for table rows based on the record data. Accepts a string, array of classes, or a closure.

```php
public function configure(): void
{
  $this->setPrimaryKey('id')
      ->recordClasses(fn($record) => match($record->status) {
          'active' => 'bg-green-100',
          'inactive' => 'bg-red-100',
          default => '',
      });
}
```

You can also use a simple string or array:

```php
// String
$this->recordClasses('hover:bg-gray-50');

// Array
$this->recordClasses(['hover:bg-gray-50', 'transition-colors']);
```

### deferLoading

Enable deferred loading - table data will load asynchronously.

```php
public function configure(): void
{
  $this->setPrimaryKey('id')
      ->deferLoading();
}
```

### groupBy

Group rows by a column value. See [Row Grouping](row-grouping) for more details.

```php
public function configure(): void
{
  $this->setPrimaryKey('id')
      ->groupBy('status'); // Group rows by the 'status' column
}
```

### groupsCollapsed

Set groups to be collapsed by default.

```php
public function configure(): void
{
  $this->setPrimaryKey('id')
      ->groupBy('status')
      ->groupsCollapsed();
}
```

### groupsExpanded

Set groups to be expanded by default (default behavior).

```php
public function configure(): void
{
  $this->setPrimaryKey('id')
      ->groupBy('status')
      ->groupsExpanded();
}
```

### disableGrouping

Disable row grouping.

```php
public function configure(): void
{
  $this->setPrimaryKey('id')
      ->disableGrouping();
}
```
```