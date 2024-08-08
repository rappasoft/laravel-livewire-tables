---
title: Saving Table State
weight: 6
---

There may be occasions that you'd like to save the table state, for example if you have a complex set of filters, search parameters, or simply to remember which page you were on!

You may call the following method to retrieve the state of the table:
```php
$this->getTableStateToArray();
```

And to restore it, you should call the following method, passing the stored array.
```php
$this->restoreStateFromArray(array $storedArray)
```
