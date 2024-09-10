<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\ComponentConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\ComponentHelpers;

trait ComponentUtilities
{
    use ComponentConfiguration,
        ComponentHelpers;

    public array $table = [];

    protected Builder $builder;

    protected $model;

    protected ?string $primaryKey;

    protected array $relationships = [];

    #[Locked]
    public string $tableName = 'table';

    #[Locked]
    public ?string $dataTableFingerprint;

    protected bool $offlineIndicatorStatus = true;

    protected bool $eagerLoadAllRelationsStatus = false;

    protected string $emptyMessage = 'No items found. Try to broaden your search.';

    protected array $additionalSelects = [];

    protected array $extraWiths = [];

    protected array $extraWithCounts = [];

    protected array $extraWithSums = [];

    protected array $extraWithAvgs = [];

    protected bool $useComputedProperties = true;

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
        if (! isset($this->theme) || is_null($this->theme)) {
            $this->setTheme(config('livewire-tables.theme', 'tailwind'));
        }
        $this->generateDataTableFingerprint();

    }

    /**
     * Runs configure() with Lifecycle Hooks on each Lifecycle
     */
    public function bootedComponentUtilities(): void
    {
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
            throw new DataTableConfigurationException('You must set a primary key using setPrimaryKey in the configure method, or configuring/configured lifecycle hooks');
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
