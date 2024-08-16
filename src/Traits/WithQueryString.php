<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\QueryStringConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\QueryStringHelpers;

trait WithQueryString
{
    use QueryStringConfiguration,
        QueryStringHelpers;

    #[Locked]
    public ?bool $queryStringStatus;

    protected ?string $queryStringAlias;

    /**
     * Set the custom query string array for this specific table
     *
     * @return array<mixed>
     */
    protected function queryStringWithQueryString(): array
    {

        if ($this->queryStringIsEnabled()) {
            return [
                $this->getTableName() => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAlias()],
            ];
        }

        return [];
    }
}
