---
title: Upgrade Guide
weight: 5
---

To upgrade from v2 to v3 is relatively simple.  The core functionality from v2 is maintained and expects the same parameters.

### Common Issues

#### Views
- The most common issue occurs when you have previously published the views for this package.  When you upgrade, you'll get an error relating to "id" not existing.  This is due to a core change within Livewire itself.

We'd always advise that you should not publish this package's views unless you have a need to modify them.  If you do choose to publish the views, then you should always remove any published views that you haven't modified, as Laravel will retrieve the core views where the are not published.  

The reason for this - there are very regular updates to the views as we introduce new features, or fix bugs.  

Keep in mind that there are available methods for changing the majority of classes/attributes across most of the table.

#### Missing Classes (Tailwind)
When using Tailwind for *production*, you will typically build and bundle your assets.  You should ensure that you have added the following path(s) to your "purge" or "content" sections in your Tailwind config file:
```js
    content: [
        './vendor/rappasoft/laravel-livewire-tables/resources/views/**/*.blade.php',
    ];
```

It is often wise to add in the path to your Livewire folder (e.g. app/Livewire/**/*.php) too, to ensure that any custom classes you're using are also incldued.

#### Dark mode (Tailwind)
You must add the following to your Tailwind Config file, for dark mode to use a class-based approach
```js
    darkMode: 'class',
```

### Major Changes

There a few key areas that have been changed, notably:

### Custom Assets
The package uses a CSS and JS file, rather than relying on in-line code in the views, you may publish this, use blade directives, use the auto-injection capability (similar to Livewire), or bundle it into your production-ready CSS and JS files.
Please see here [https://rappasoft.com/docs/laravel-livewire-tables/v3/start/including-assets](https://rappasoft.com/docs/laravel-livewire-tables/v3/start/including-assets) for more information on available approaches

### Reordering
There have been several changes and tweaks to the behaviour of this area, including:
- Removal of dependency on Livewire Sortable
- Ability to specify order fields more smoothly
- Reorder method respects the defined primary key, rather than expecting "id".
For more details, please see
[https://rappasoft.com/docs/laravel-livewire-tables/v3/reordering/introduction](https://rappasoft.com/docs/laravel-livewire-tables/v3/reordering/introduction)