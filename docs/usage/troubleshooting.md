---
title: Troubleshooting
weight: 4
---

If you are having unexpected results, try these before making an issue or discussion:

## 1. Delete your 'resources/views/vendor/livewire-tables' folder if you have one and see if the issue persists with the vendor views.

## 2. Clear everything:

```
php artisan clear-compiled &&
php artisan cache:clear &&
php artisan route:clear &&
php artisan view:clear &&
php artisan config:clear &&
composer dumpautoload -o
```

## 3. If you have style issues, make sure you are either loading the correct version of Bootstrap or your Tailwind install isn't purging the classes that are missing.

If you are still having the issue, proceed to make a discussion or issue request if you know the exact problem. Or even more helpful, make a pull request fixing the issue if you can.

## 4. If you are getting unexpected row results after filtering/search etc.

Make sure your query returns a column that is being used as the primary key for the row. By default, it looks for the `id` column but you can set it using the `$primaryKey` property.

Livewire uses this as the `wire:key` to know which rows to keep and remove during its dom-diffing.

## 5. Enable debugging

If you would like to dump the contents of the filters above the table you may enable this flag:

```php
public bool $dumpFilters = true;
```
