---
title: Actions (beta)
weight: 4
---

### Usage
To use "Actions", while it is in beta, you must include the following Trait in your table:
```php
use Rappasoft\LaravelLivewireTables\Traits\WithActions;
```

This is NOT recommended for production use at this point in time.

You can utilise "Action Buttons" to add functionality above the Toolbar, such as "Create" buttons.

### actions()

Define your actions using the actions() method:

```php
public function actions(): array
{
    return [
        Action::make('Update Summaries')
        ->setActionAttributes(['class' => 'bg-green-500 text-black border-green-600 hover:border-green-900 hover:bg-green-800', 'default' => true])
        ->setIcon("fas fa-minus")
        ->setIconAttributes(['class' => 'font-sm text-sm'])
        ->setRoute('dashboard2'),
    ];
}
```

### setActionAttributes

setActionAttributes is used to pass any attributes that you wish to implement on the "button" element for the action button.  By default it will merge with the default classes, set "default" to false to mitigate this.

### setIcon

setIcon is used to set an icon for the action button

### setIconAttributes

setIconAttributes is used to set any additional attributes for the Icon for the action button

### setRoute

Used for non-wireable butons, to set the route that the action button should take the user to upon clicking.

### wireNavigate

Used in conjunction with setRoute - makes the link "wire:navigate" rather than default behaviour

### setActionWrapperAttributes

This is used to set attributes for the "div" that wraps any Action Buttons:

```php
    public function configure(): void
    {
        $this->setActionWrapperAttributes(['class' => 'space-x-4']);
    }
```


