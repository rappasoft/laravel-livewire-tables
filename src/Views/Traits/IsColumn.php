<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Traits\Core\HasLocalisations;
use Rappasoft\LaravelLivewireTables\Views\Traits\Columns\{HasColumnView, HasVisibility, IsCollapsible, IsSearchable, IsSelectable, IsSortable};
use Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\ColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\{HasAttributes, HasFooter, HasLabelAttributes, HasSecondaryHeader, HasTheme};
use Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\{ColumnHelpers,RelationshipHelpers};

trait IsColumn
{
    use HasLocalisations,
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

    protected ?DataTableComponent $component = null;

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
