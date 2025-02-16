<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Core\HasLocalisations;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Configuration\ColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Helpers\{ColumnHelpers,RelationshipHelpers};
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\{HasColumnView, HasFooter, HasSecondaryHeader, HasVisibility, IsCollapsible, IsSearchable, IsSelectable, IsSortable};
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\{HasAttributes, HasLabelAttributes, HasTheme};

trait IsColumn
{
    use HasLocalisations,
        HasDataTableComponent,
        ColumnConfiguration,
        ColumnHelpers,
        RelationshipHelpers,
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

    // An array of relationships: i.e. address.group.name => ['address', 'group']
    protected array $relations = [];

    protected bool $eagerLoadRelations = false;

    protected mixed $formatCallback = null;

    protected bool $html = false;

    protected mixed $labelCallback = null;

    protected bool $clickable = true;

    protected ?string $customSlug = null;

    protected bool $hasTableRowUrl = false;

    protected bool $isReorderColumn = false;

    protected ?int $columnIndex;

    protected ?int $rowIndex;
}
