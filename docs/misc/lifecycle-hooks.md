---
title: Lifecycle Hooks
weight: 7
---

With the migration to Livewire 3, there we are implementing several Lifecycle Hooks to assist with re-using methods across multiple Table Components.

You may use these either in your Table Component, or in a trait

## configuring
This is called immediately prior to the configure() method being called.  This will be overridden by anything you define in configure()

## configured
This is called immediately after the configure() method is called.  This will override anything you define in configure()

## settingColumns
This is called prior to setting up the available Columns via the columns() method

## columnsSet
This is called immediately after the Columns are set up

## rowsRetrieved
This is called immediately after the query is executed, and is passed the result from the executed query.

## Use in Traits
To use these in a trait, allowing you to easily set defaults across multiple tables, you should ensure that you append the Lifecycle Hook with your trait name, e.g.

You can then add the trait to your tables, allowing you to centralise your defaults, and avoid code duplication.

```php
trait StandardTableMethods
{

    public function configuringStandardTableMethods()
    {
        // Your standard configure() options go here, anything set here will be over-ridden by the configure() method
        // For Example
        $this->setColumnSelectDisabled();
    }

    public function configuredStandardTableMethods()
    {
        // Your standard configure() options go here, anything set here will override those set in the configure() method
        // For Example
        $this->setColumnSelectDisabled();
    }

}
```