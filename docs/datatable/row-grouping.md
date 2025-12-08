# Row Grouping

Row grouping allows you to group table rows by a column value, making it easier to organize and view related data.

## Basic Usage

Enable grouping by calling `groupBy()` in your `configure()` method:

```php
public function configure(): void
{
    $this->setPrimaryKey('id')
        ->groupBy('status'); // Group rows by the 'status' column
}
```

## Grouping Options

### Collapsed Groups

By default, groups are expanded. To collapse groups by default:

```php
public function configure(): void
{
    $this->setPrimaryKey('id')
        ->groupBy('status')
        ->groupsCollapsed(); // Groups will be collapsed by default
}
```

### Expanded Groups

To ensure groups are expanded by default:

```php
public function configure(): void
{
    $this->setPrimaryKey('id')
        ->groupBy('status')
        ->groupsExpanded(); // Groups will be expanded by default
}
```

## Disabling Grouping

To disable grouping:

```php
public function configure(): void
{
    $this->setPrimaryKey('id')
        ->disableGrouping();
}
```

## Accessing Grouped Data

The `getGroupedRows()` method returns rows grouped by the specified column:

```php
$groupedRows = $this->getGroupedRows($this->getRows());
// Returns: Collection with groups as keys
```

## Group State

You can check if a group is expanded:

```php
if ($this->isGroupExpanded('active')) {
    // Group is expanded
}
```

## Toggling Groups

Groups can be toggled via Livewire wire:click:

```blade
<button wire:click="toggleGroup('{{ $groupKey }}')">
    Toggle Group
</button>
```

## Example

```php
class UsersTable extends DataTableComponent
{
    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->groupBy('status')
            ->groupsCollapsed();
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'name'),
            Column::make('Email', 'email'),
            Column::make('Status', 'status'),
        ];
    }
}
```

This will group all users by their status, with groups collapsed by default. Users can click to expand/collapse groups as needed.

