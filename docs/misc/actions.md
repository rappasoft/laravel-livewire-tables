---
title: Actions (beta)
weight: 4
---

Actions is a beta feature, that allows for the creation of Action Buttons that appear above the toolbar.  These are ideal for common Actions that do not impact existing records, such as a "Create", "Assign", "Back" buttons.

This is NOT recommended for production use at this point in time.

## Component Available Methods
### setActionWrapperAttributes

This is used to set attributes for the "div" that wraps all defined Action Buttons:

```php
    public function configure(): void
    {
        $this->setActionWrapperAttributes([
            'class' => 'space-x-4'
        ]);
    }
```

### setActionsInToolbarEnabled

Displays the Actions within the Toolbar.  Default is displaying above the Toolbar.

```php
    public function configure(): void
    {
        $this->setActionsInToolbarEnabled();
    }
```

### setActionsInToolbarDisabled

Displays the Actions above the Toolbar, default behaviour
```php
    public function configure(): void
    {
        $this->setActionsInToolbarDisabled();
    }
```


### setActionsLeft

Displays the Actions justified to the left

```php
    public function configure(): void
    {
        $this->setActionsLeft();
    }
```

### setActionsCenter

Displays the Actions justified to the center

```php
    public function configure(): void
    {
        $this->setActionsCenter();
    }
```

### setActionsRight

Displays the Actions justified to the right

```php
    public function configure(): void
    {
        $this->setActionsRight();
    }
```

### actions()

Define your actions using the actions() method:

```php
public function actions(): array
{
    return [
        Action::make('View Dashboard')
        ->setRoute('dashboard'),
    ];
}
```

## Button Available Methods

### setLabelAttributes
Set custom attributes for an Action Label.  At present it is recommended to only use this for "class" and "style" attributes to avoid conflicts.

By default, this replaces the default classes on the Action Label, if you would like to keep them, set the default flag to true.

```php
Action::make('Dashboard')
    ->setRoute('dashboard')
    ->wireNavigate()
    ->setLabelAttributes([
        'class' => 'text-xl', 
        'default' => true,
    ]),
```

### setActionAttributes

setActionAttributes is used to pass any attributes that you wish to implement on the "button" element for the action button.  By default it will merge with the default classes. 

You can set "default-styling" and "default-colors" to false to replace, rather than over-ride either default-styling or default-colors.
```php
public function actions(): array
{
    return [
        Action::make('View Dashboard')
            ->setActionAttributes([
                'class' => 'dark:bg-blue-500 dark:text-white dark:border-blue-600 dark:hover:border-blue-900 dark:hover:bg-blue-800', 
                'default-colors' => false, // Will over-ride the default colors
                'default-styling' => true // Will use the default styling
            ]),
    ];
}
```

### setIcon

setIcon is used to set an icon for the action button

```php
public function actions(): array
{
    return [
        Action::make('Edit Item')
        ->setIcon("fas fa-edit"),
    ];
}
```

### setIconAttributes

setIconAttributes is used to set any additional attributes for the Icon for the action button
```php
public function actions(): array
{
    return [
        Action::make('Edit Item')
        ->setIcon("fas fa-edit")
        ->setIconAttributes(['class' => 'font-4xl text-4xl']),
    ];
}
```

### setIconLeft

setIconLeft is used to prepend the Icon to the Text (Non-Default Behaviour)

```php
public function actions(): array
{
    return [
        Action::make('Edit Item')
        ->setIcon("fas fa-edit")
        ->setIconAttributes(['class' => 'font-4xl text-4xl'])
        ->setIconLeft(),
    ];
}
```

### setIconRight

setIconRight is used to append the Icon to the Text (Default Behaviour)

```php
public function actions(): array
{
    return [
        Action::make('Edit Item')
        ->setIcon("fas fa-edit")
        ->setIconAttributes(['class' => 'font-4xl text-4xl'])
        ->setIconRight(),
    ];
}
```

### setRoute

Used for non-wireable butons, to set the route that the action button should take the user to upon clicking.
```php
public function actions(): array
{
    return [
        Action::make('Dashboard')
        ->setRoute('dashboard')
    ];
}
```

### wireNavigate

Used in conjunction with setRoute - makes the link "wire:navigate" rather than default behaviour
```php
public function actions(): array
{
    return [
        Action::make('Dashboard')
        ->setRoute('dashboard')
        ->wireNavigate()
    ];
}
```

### setWireAction
```php
public function actions(): array
{
    return [
        Action::make('Create 2')
        ->setWireAction("wire:click")
    ];
}
```

### setWireActionParams
Specify the action & parameters to pass to the wire:click method

```php
public function actions(): array
{
    return [
        Action::make('Create 2')
        ->setWireAction("wire:click")
        ->setWireActionParams(['id' => 'test']),
    ];
}
```

### setWireActionDispatchParams

Use $dispatch rather than a typical wire:click action

```php
public function actions(): array
{
    return [
        Action::make('Create 2')
        ->setWireAction("wire:click")
        ->setWireActionDispatchParams("'openModal', { component: 'test-modal' }"),
    ];
}
```

### setView

This is used to set a Custom View for the Button

```php
public function actions(): array
{
    return [
        Action::make('Edit Item')
        ->setView("buttons.edit"),
    ];
}
```


## Extending

You can extend the Base Action class which can be a useful timesaver, when you wish to re-use the same look/feel of an Action, but wish to set a different route (for example).
You can set any defaults in the __construct method, ensuring that the parent constructor is called first!

```php
use Rappasoft\LaravelLivewireTables\Views\Action;

class EditAction extends Action
{
    public function __construct(?string $label = null)
    {
        parent::__construct($label);
        $this
            ->setActionAttributes([
                'class' => 'dark:bg-blue-500 dark:text-white dark:border-blue-600 dark:hover:border-blue-900 dark:hover:bg-blue-800', 
                'default-colors' => false, 
                'default-styling' => true
            ])
            ->setIcon("fas fa-edit")
            ->setIconAttributes([
                'class' => 'font-4xl text-4xl'
            ]);
    }
}
```

You may define a Custom View to be used via either the setView method, or by defining the view directly in your class.
```php
    protected string $view = 'buttons.edit-action';
```

