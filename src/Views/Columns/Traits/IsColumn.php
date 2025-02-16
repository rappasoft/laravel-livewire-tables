<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Core\HasLocalisations;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Configuration\ColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Helpers\{ColumnHelpers};
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\{HasAttributes, HasLabelAttributes, HasTheme};

trait IsColumn
{
    use HasLocalisations,
        HasDataTableComponent,
        IsReorderColumn,
        HasColumnLabelStatus,
        HasRelations,
        HasLabelFormat,
        HasClickable,
        HasSlug,
        ColumnConfiguration,
        ColumnHelpers,
        IsCollapsible,
        IsSearchable,
        IsSelectable,
        IsSortable,
        HasAttributes,
        HasColumnView,
        HasFooter,
        HasLabelAttributes,
        HasSecondaryHeader,
        HasTheme,
        HasVisibility;

    // What displays in the columns header
    protected string $title;

    // Act as a unique identifier for the column
    protected string $hash;

    // The columns or relationship location: i.e. name, or address.group.name
    protected ?string $from = null;

    // The underlying columns name: i.e. name
    protected ?string $field = null;

    // The table of the columns or relationship
    protected ?string $table = null;

    protected bool $html = false;

    protected ?int $columnIndex;

    protected ?int $rowIndex;
}
