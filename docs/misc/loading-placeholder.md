---
title: Loading Placeholder
weight: 2
---

When running complex filters or searches, or displaying larger number of records, you can make use of the built-in Loading Placeholder, this is disabled by default.

### setLoadingPlaceholderStatus
You may pass a boolean to this, which will either enable (true) or disable (false) the loading placeholder

```php
    public function configure(): void
    {
        $this->setLoadingPlaceholderStatus(true);
    }
```

### setLoadingPlaceholderEnabled

Use this method to enable the loading placeholder:

```php
    public function configure(): void
    {
        $this->setLoadingPlaceholderEnabled();
    }
```

### setLoadingPlaceholderDisabled

Use this method to disable the loading placeholder:

```php
    public function configure(): void
    {
        $this->setLoadingPlaceholderDisabled();
    }
```

### setLoadingPlaceholderContent

You may use this method to set custom text for the placeholder:

```php
    public function configure(): void
    {
        $this->setLoadingPlaceholderContent('Text To Display');
    }
```
### setLoadingPlaceHolderWrapperAttributes (Deprecated)

This is replaced by setLoadingPlaceHolderRowAttributes, but remains functional.

This method allows you to customise the attributes for the &lt;tr&gt; element used as a Placeholder when the table is loading.  Similar to other setAttribute methods, this accepts a range of attributes, and a boolean "default", which will enable/disable the default attributes.

```php
    public function configure(): void
    {
        $this->setLoadingPlaceHolderWrapperAttributes([
            'class' => 'text-bold',
            'default' => false,
        ]);
    }

```

### setLoadingPlaceHolderRowAttributes

Replaces setLoadingPlaceHolderWrapperAttributes
This method allows you to customise the attributes for the &lt;tr&gt; element used as a Placeholder when the table is loading.  Similar to other setAttribute methods, this accepts a range of attributes, and a boolean "default", which will enable/disable the default attributes.

```php
    public function configure(): void
    {
        $this->setLoadingPlaceHolderRowAttributes([
            'class' => 'text-bold',
            'default' => false,
        ]);
    }

```

### setLoadingPlaceHolderIconAttributes

This method allows you to customise the attributes for the &lt;div&gt; element that is used solely for the PlaceholderIcon.  Similar to other setAttribute methods, this accepts a range of attributes, and a boolean "default", which will enable/disable the default attributes.

```php
    public function configure(): void
    {
        $this->setLoadingPlaceHolderIconAttributes([
            'class' => 'lds-hourglass',
            'default' => false,
        ]);
    }

```
