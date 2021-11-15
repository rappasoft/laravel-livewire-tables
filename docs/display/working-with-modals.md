---
title: Modals
weight: 5
---

**This feature is available in v1.8 and above**

The package itself does not provide any modal functionality, but it does give you a placeholder view to put your modal code in the context of the table component. This way you can control the visibility of your modal from the table component instead of having to wrap it in a parent component.

You can load your modal code using this component method:

```php
public function modalsView(): string
{
    return 'table.includes.modals';
}
```

Use the path to your view in your system.

The HTML will be placed right after the table.

## Example: Opening a modal on row click

Here's an example of opening a modal on row click and passing some data.

### Add properties to manage the modal.

```php
// To show/hide the modal
public bool $viewingModal = false;

// The information currently being displayed in the modal
public $currentModal;
```

### Enable the row click but don't return a URL.

This step is technically optional, but without it, you will get no pointer cursor or highlight of the row on hover.

```php
public function getTableRowUrl(): string
{
    return '#';
}
```

### Add a custom attribute with a wire:click:

```php
public function setTableRowAttributes($row): array
{
    return ['wire:click.prevent' => 'viewModal('.$row->id.')'];
}
```

Here I've added method to call with the selected row that will display our modal.

### Implement the method to manage your modal:

```php
 public function viewHistoryModal($modelId): void
{
    $this->viewingModal = true;
    $this->currentModal = MyModel::findOrFail($modelId);
}
```

### Add a method to reset the modal:

```php
public function resetModal(): void
{
    $this->reset('viewingModal', 'currentModal');
}
```

### Add your modal markup using the `modalsView` method:

```php
public function modalsView(): string
{
    return 'admin.livewire.my-model.includes.modal';
}
```

For our example modal, I'm going to use a Jetstream component:

```html
<x-jet-dialog-modal wire:model="viewingModal">
    <x-slot name="title">
        @lang('My Modal')
    </x-slot>

    <x-slot name="content">
        {{ $currentModal is available here }}
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="resetModal" wire:loading.attr="disabled">
            @lang('Done')
        </x-jet-secondary-button>
    </x-slot>
</x-jet-dialog-modal>
```

Now when you click a row, a modal will appear with the given information for the row, and when you click away or hit the Done button, the information will be reset and the modal will disappear.

### Working with links on clickable rows that display a modal:

See: [Working with links on clickable rows](../rows/clickable-rows)
