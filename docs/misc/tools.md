---
title: Tools
weight: 9
---

The Table offers additional configuration to show/hide the Tools/Toolbar sections:
## Tools
Contains:
- Filter Pills
- Sorting Pills
- The Toolbar

## Toolbar
Contains:
- Actions (if set to Toolbar)
- Column Select dropdown
- Configurable Areas for Toolbar
- Filters Button/Dropdown/Popover
- Pagination dropdown
- Reorder Button
- Search Input

## Component Available Methods

### setToolsEnabled
The Default Behaviour, Tools Are Enabled.  But will only be rendered if there are available/enabled elements.  If the Toolbar is enabled, this takes into account any Toolbar elements that are present.
```php
    public function configure(): void
    {
        $this->setToolsEnabled();
    }
```

### setToolsDisabled
Disables the Tools section, this includes the Toolbar, and Sort/Filter pills
```php
    public function configure(): void
    {
        $this->setToolsDisabled();
    }
```

### setToolBarEnabled
The Default Behaviour, ToolBar is Enabled.  But will only be rendered if there are available/enabled elements
```php
    public function configure(): void
    {
        $this->setToolBarEnabled();
    }
```

### setToolBarDisabled
Disables the Toolbar, which contains the Reorder, Filters, Search, Column Select, Pagination buttons/options.  Does not impact the Filter/Sort pills (if enabled)
```php
    public function configure(): void
    {
        $this->setToolBarDisabled();
    }
```

### setToolsAttributes
Allows setting of attributes for the parent element in the tools blade

By default, this replaces the default classes on the tools blade, if you would like to keep them, set the default-colors/default-styling flags to true as appropriate

```php
    public function configure(): void
    {
       $this->setToolsAttributes(['class' => ' bg-green-500', 'default-colors' => false, 'default-styling' => true]);
    }
```

### setToolBarAttributes
Allows setting of attributes for the parent element in the toolbar blade.

By default, this replaces the default classes on the toolbar blade, if you would like to keep them, set the default-colors/default-styling flags to true as appropriate

```php
    public function configure(): void
    {
       $this->setToolBarAttributes(['class' => ' bg-red-500', 'default-colors' => false, 'default-styling' => true]);
    }
```
