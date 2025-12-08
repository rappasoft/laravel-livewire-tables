<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\SummariesConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\SummariesHelpers;

trait WithSummaries
{
    use SummariesConfiguration,
        SummariesHelpers;

    protected bool $summariesStatus = false;

    protected array $summaryColumns = [];

    public function setupSummaries(): void
    {
        $this->summaryColumns = [];
        
        foreach ($this->getColumns() as $column) {
            if ($column->hasSummary()) {
                $this->summaryColumns[] = $column;
                $this->summariesStatus = true;
            }
        }
    }

    public function renderingWithSummaries(?\Illuminate\View\View $view = null, array $data = []): void
    {
        $this->setupSummaries();
    }
}

