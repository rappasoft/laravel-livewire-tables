---
title: Clickable Rows
weight: 1
---

If you would like to make the whole row clickable, you may use the `getTableRowUrl` method:

```php
public function getTableRowUrl($row): string
{
    return route('my.edit.route', $row);
}
```

It will be passed the current model as `$row`.

## Setting the target

If you would like to set the click target to anything other than `_self` you may use the following method:

**The following method is only available in v1.19 and above**

```php
public function getTableRowUrlTarget($row): ?string
{
    if ($row->type === 'this') {
        return '_blank';
    }

    return null;
}
```

## Working with links on clickable rows

Since the row itself is clickable, you might have issues with event bubbling if you have links in your cells on top of the clickable rows. My current solution is to use Livewire to prevent the default action and stop the event bubbling and then redirect.

For example, you have a link in a cell that's in a clickable row:

```html
<a href="#" wire:click.stop.prevent="redirectToModel('admin.auth.user.edit', [{{ $user }}])" class="font-medium">{{ $user->name }}</a>
```

The `.stop` will prevent the row click action from happening, the `.prevent` will preserve your URL history in case you are using `#` to control page content.

Then in your table you need that method:

```php
public function redirectToModel(string $name, array $parameters = [], $absolute = true): void
{
    $this->redirectRoute($name, $parameters, $absolute);
}
```

Now the blank space of the row should have its action, while your links go to their own action.

## Working with `wire:click` on rows

You can add the row-level Livewire clicks by utilizing the following method.

```php
public function getTableRowWireClick($row): ?string
{
    return "doSomething(" . $row->id . ")";
}

public function doSomething($id)
{
    // ...
}
```

If you state both `getTableRowUrl` & `getTableRowWireClick`, the URL will supersede when a non-null value is supplied.
