---
title: Saving
weight: 3
---

When you click the "Save" button, your ordered elements will be returned as an array, to the function you have configured.

You will receive a multi-dimensional array, containing an array item per record, with the primary key, and order field.

The package only passes on rows that your `builder()` returns, reduced to the primary key and an integer order field, so it is in the correct format to perform upserts. You should still check that the user is allowed to reorder.

```php
public function reorder(array $items): void
{
    // $item[$this->getPrimaryKey()] ensures that the Primary Key is used to find the User
    // 'sort' is the name of your "sort" field in your database
    // $item[$this->getDefaultReorderColumn()] retrieves the field, as defined in setDefaultReorderSort('FIELD', 'ORDER')

    foreach ($items as $item) {
        User::find($item[$this->getPrimaryKey()])->update(['sort' => (int)$item[$this->getDefaultReorderColumn()]]);
    }
}

```

If you have defined both the Primary Key, and the Order Column, and the fields match your database, then you could use an upsert().  Keep in mind that an upsert does not go through validation, and you should exercise caution with this approach
```php
public function reorder(array $items): void
{
    // First value is the array of items
    // Second value should be the unique id (set in setPrimaryKey())
    // Third value should be the field set in setDefaultReorderSort('FIELD', 'ORDER')
    User::upsert($items, [$this->getPrimaryKey()], [$this->getDefaultReorderColumn()]);
}

```