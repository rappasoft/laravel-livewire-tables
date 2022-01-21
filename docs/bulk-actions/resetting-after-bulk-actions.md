---
title: Resetting after bulk actions
weight: 5
---

If your bulk action is changing the outcome of your table, i.e. you are deleting rows or changing criteria that would alter the row set with the search criteria you have, then you may have unexpected results after the bulk action runs.

There is no one good way to handle this, so there are a few options available to you:

## 1. Reset all the filters and criteria.

You can reset all the filters, search, page, sorts, etc. With this method, that will essentially reload the table to what it was on the first page load with your bulk changes since the query will re-run:

```php
public function deleteSelected()
{
    // Delete the rows

    $this->resetAll();
}
```

## 2. Reset specific criteria

You may at the end of your bulk action method reset specific parts of the UI with any of the following methods:

```php
public function myBulkAction()
{
    // Do something with the rows

    // Use any of these to reset the UI to a point that makes sense after your bulk action is run:
    $this->resetFilters(); // Remove all the filters
    $this->resetSearch(); // Remove the search query
    $this->resetSorts(); // Remove the sorts
    $this->resetBulk(); // Clear the selected rows
    $this->resetPage($this->pageName()); // Go back to page 1
}
```
