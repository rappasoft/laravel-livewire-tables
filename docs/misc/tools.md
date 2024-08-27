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