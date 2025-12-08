<?php

declare(strict_types=1);

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\ComponentConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\ComponentHelpers;

/**
 * Core component utilities and properties
 */
trait ComponentUtilities
{
    use ComponentConfiguration,
        ComponentHelpers;

    /**
     * Table configuration array
     * @var array<string, mixed>
     */
    public array $table = [];

    /**
     * Current theme (tailwind/bootstrap)
     */
    public ?string $theme = null;

    /**
     * Query builder instance
     */
    protected Builder $builder;

    /**
     * Model class for the table
     * @var class-string|null
     */
    protected $model;

    /**
     * Primary key column name
     */
    protected ?string $primaryKey = null;

    /**
     * Eager load relationships
     * @var array<int, string>
     */
    protected array $relationships = [];

    /**
     * Unique table name for query string/session
     */
    protected string $tableName = 'table';

    /**
     * Unique fingerprint for this table instance
     */
    protected ?string $dataTableFingerprint = null;

    /**
     * Whether to show offline indicator
     */
    protected bool $offlineIndicatorStatus = true;

    /**
     * Whether to eager load all relations
     */
    protected bool $eagerLoadAllRelationsStatus = false;

    /**
     * Default empty state message
     */
    protected string $emptyMessage = 'No items found. Try to broaden your search.';

    /**
     * Custom empty state view
     */
    protected string|View|null $customEmptyStateView = null;

    /**
     * Data for custom empty state view
     * @var array<string, mixed>
     */
    protected array $customEmptyStateData = [];

    /**
     * Custom empty state heading
     */
    protected ?string $emptyStateHeading = null;

    /**
     * Custom empty state description
     */
    protected ?string $emptyStateDescription = null;

    /**
     * Additional select columns
     * @var array<int, string>
     */
    protected array $additionalSelects = [];

    /**
     * Extra relationships to eager load
     * @var array<int, string>
     */
    protected array $extraWiths = [];

    /**
     * Extra withCount relationships
     * @var array<int, string>
     */
    protected array $extraWithCounts = [];

    /**
     * Extra withSum relationships
     * @var array<string, array<int, string>>
     */
    protected array $extraWithSums = [];

    /**
     * Extra withAvg relationships
     * @var array<string, array<int, string>>
     */
    protected array $extraWithAvgs = [];

    /**
     * Whether to use Livewire computed properties
     */
    protected bool $useComputedProperties = false;

    /**
     * Table heading text
     */
    protected ?string $tableHeading = null;

    /**
     * Table description text
     */
    protected ?string $tableDescription = null;

    /**
     * Custom header view
     */
    protected string|View|null $customHeaderView = null;

    /**
     * Data for custom header view
     * @var array<string, mixed>
     */
    protected array $customHeaderData = [];

    /**
     * Set any configuration options
     */
    abstract public function configure(): void;

    /**
     * Sets the Theme if not set on first mount
     */
    public function mountComponentUtilities(): void
    {
        // Sets the Theme - tailwind/bootstrap
        if (is_null($this->theme)) {
            $this->setTheme();
        }
    }

    /**
     * Runs configure() with Lifecycle Hooks on each Lifecycle
     */
    public function bootedComponentUtilities(): void
    {
        // Apply global configuration if set
        if (method_exists($this, 'applyGlobalConfiguration')) {
            $this->applyGlobalConfiguration();
        }

        // Fire Lifecycle Hooks for configuring
        $this->callHook('configuring');
        $this->callTraitHook('configuring');

        // Call the configure() method
        $this->configure();

        // Fire Lifecycle Hooks for configured
        $this->callHook('configured');
        $this->callTraitHook('configured');

        // Make sure a primary key is set
        if (! $this->hasPrimaryKey()) {
            throw new DataTableConfigurationException('You must set a primary key using setPrimaryKey in the configure method.');
        }

    }

    /**
     * Returns a unique id for the table, used as an alias to identify one table from another session and query string to prevent conflicts
     */
    protected function generateDataTableFingerprint(): string
    {
        $className = str_split(static::class);
        $crc32 = sprintf('%u', crc32(serialize($className)));

        return base_convert($crc32, 10, 36);
    }

    /**
     * 1. After the sorting method is hit we need to tell the table to go back into reordering mode
     */
    public function hydrate(): void
    {
        $this->restartReorderingIfNecessary();
    }
}
