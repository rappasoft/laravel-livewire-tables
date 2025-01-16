<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\ComponentConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Core\Component\{HandlesComputedProperties,HandlesEmptyMessage, HandlesFingerprint, HandlesOfflineIndicator,HandlesTableName};
use Rappasoft\LaravelLivewireTables\Traits\Helpers\ComponentHelpers;

trait ComponentUtilities
{
    use HandlesTableName,
        HandlesFingerprint,
        HandlesEmptyMessage,
        HandlesComputedProperties,
        HandlesOfflineIndicator,
        ComponentConfiguration,
        ComponentHelpers;

    public array $table = [];

    protected $model;

    protected bool $hasRunConfigure = false;

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
        $this->runCoreConfiguration();

        // Make sure a primary key is set
        if (! $this->hasPrimaryKey()) {
            throw new DataTableConfigurationException('You must set a primary key using setPrimaryKey in the configure method, or configuring/configured lifecycle hooks');
        }

    }

    protected function runCoreConfiguration(): void
    {
        if (! $this->hasRunConfigure) {
            // Fire Lifecycle Hooks for configuring
            $this->callHook('configuring');
            $this->callTraitHook('configuring');

            // Call the configure() method
            $this->configure();

            // Fire Lifecycle Hooks for configured
            $this->callHook('configured');
            $this->callTraitHook('configured');

            $this->hasRunConfigure = true;

        }
    }

    /**
     * 1. After the sorting method is hit we need to tell the table to go back into reordering mode
     */
    public function hydrate(): void
    {
        $this->restartReorderingIfNecessary();
    }
}
