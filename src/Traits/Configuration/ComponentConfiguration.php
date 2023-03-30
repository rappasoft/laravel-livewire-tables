<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait ComponentConfiguration
{
    /**
     * @param  string|null  $key
     *
     * @return self
     */
    public function setPrimaryKey(?string $key): self
    {
        $this->primaryKey = $key;

        return $this;
    }

    /**
     * Get a list of attributes to override on the main wrapper of the component
     *
     * @param  array<mixed>  $attributes
     *
     * @return $this
     */
    public function setComponentWrapperAttributes(array $attributes = []): self
    {
        $this->componentWrapperAttributes = $attributes;

        return $this;
    }

    /**
     * Set a list of attributes to override on the div that wraps the table
     *
     * @param  array<mixed>  $attributes
     *
     * @return self
     */
    public function setTableWrapperAttributes(array $attributes = []): self
    {
        $this->tableWrapperAttributes = $attributes;

        return $this;
    }

    /**
     * Set a list of attributes to override on the table element
     *
     * @param  array<mixed>  $attributes
     *
     * @return self
     */
    public function setTableAttributes(array $attributes = []): self
    {
        $this->tableAttributes = $attributes;

        return $this;
    }

    /**
     * Set a list of attributes to override on the thead element
     *
     * @param  array<mixed>  $attributes
     *
     * @return self
     */
    public function setTheadAttributes(array $attributes = []): self
    {
        $this->theadAttributes = $attributes;

        return $this;
    }

    /**
     * Set a list of attributes to override on the tbody element
     *
     * @param  array<mixed>  $attributes
     *
     * @return self
     */
    public function setTbodyAttributes(array $attributes = []): self
    {
        $this->tbodyAttributes = $attributes;

        return $this;
    }

    /**
     * Set a list of attributes to override on the th elements
     *
     * @param  callable  $callback
     *
     * @return self
     */
    public function setThAttributes(callable $callback): self
    {
        $this->thAttributesCallback = $callback;

        return $this;
    }

    /**
     * Set a list of attributes to override on the th sort button elements
     *
     * @param  callable  $callback
     *
     * @return self
     */
    public function setThSortButtonAttributes(callable $callback): self
    {
        $this->thSortButtonAttributesCallback = $callback;

        return $this;
    }

    /**
     * Set a list of attributes to override on the td elements
     *
     * @param  callable  $callback
     *
     * @return self
     */
    public function setTrAttributes(callable $callback): self
    {
        $this->trAttributesCallback = $callback;

        return $this;
    }

    /**
     * Set a list of attributes to override on the td elements
     *
     * @param  callable  $callback
     *
     * @return self
     */
    public function setTdAttributes(callable $callback): self
    {
        $this->tdAttributesCallback = $callback;

        return $this;
    }

    /**
     * Set the empty message
     *
     * @param  string  $message
     *
     * @return self
     */
    public function setEmptyMessage(string $message): self
    {
        $this->emptyMessage = $message;

        return $this;
    }

    /**
     * @param  bool  $status
     *
     * @return self
     */
    public function setOfflineIndicatorStatus(bool $status): self
    {
        $this->offlineIndicatorStatus = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setOfflineIndicatorEnabled(): self
    {
        $this->setOfflineIndicatorStatus(true);

        return $this;
    }

    /**
     * @return self
     */
    public function setOfflineIndicatorDisabled(): self
    {
        $this->setOfflineIndicatorStatus(false);

        return $this;
    }

    /**
     * @param  bool  $status
     *
     * @return self
     */
    public function setQueryStringStatus(bool $status): self
    {
        $this->queryStringStatus = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setQueryStringEnabled(): self
    {
        $this->setQueryStringStatus(true);

        return $this;
    }

    /**
     * @return self
     */
    public function setQueryStringDisabled(): self
    {
        $this->setQueryStringStatus(false);

        return $this;
    }

    /**
     * @param  bool  $status
     *
     * @return self
     */
    public function setEagerLoadAllRelationsStatus(bool $status): self
    {
        $this->eagerLoadAllRelationsStatus = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setEagerLoadAllRelationsEnabled(): self
    {
        $this->setEagerLoadAllRelationsStatus(true);

        return $this;
    }

    /**
     * @return self
     */
    public function setEagerLoadAllRelationsDisabled(): self
    {
        $this->setEagerLoadAllRelationsStatus(false);

        return $this;
    }

    /**
     * @param  bool  $status
     *
     * @return self
     */
    public function setCollapsingColumnsStatus(bool $status): self
    {
        $this->collapsingColumnsStatus = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setCollapsingColumnsEnabled(): self
    {
        $this->setCollapsingColumnsStatus(true);

        return $this;
    }

    /**
     * @return self
     */
    public function setCollapsingColumnsDisabled(): self
    {
        $this->setCollapsingColumnsStatus(false);

        return $this;
    }

    /**
     * @param  callable  $callback
     *
     * @return self
     */
    public function setTableRowUrl(callable $callback): self
    {
        $this->trUrlCallback = $callback;

        return $this;
    }

    /**
     * @param  callable  $callback
     *
     * @return self
     */
    public function setTableRowUrlTarget(callable $callback): self
    {
        $this->trUrlTargetCallback = $callback;

        return $this;
    }

    /**
     * @param  $selects
     *
     * @return self
     */
    public function setAdditionalSelects($selects): self
    {
        if (! is_array($selects)) {
            $selects = [$selects];
        }

        $this->additionalSelects = $selects;

        return $this;
    }

    /**
     * @param  array<mixed> $areas
     *
     * @return self
     */
    public function setConfigurableAreas(array $areas): self
    {
        $this->configurableAreas = $areas;

        return $this;
    }

    /**
     * @param  bool  $status
     *
     * @return self
     */
    public function setHideConfigurableAreasWhenReorderingStatus(bool $status): self
    {
        $this->hideConfigurableAreasWhenReorderingStatus = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setHideConfigurableAreasWhenReorderingEnabled(): self
    {
        $this->setHideConfigurableAreasWhenReorderingStatus(true);

        return $this;
    }

    /**
     * @return self
     */
    public function setHideConfigurableAreasWhenReorderingDisabled(): self
    {
        $this->setHideConfigurableAreasWhenReorderingStatus(false);

        return $this;
    }

    /**
     * @param string $dataTableFingerprint
     *
     * @return self
     */
    public function setDataTableFingerprint(string $dataTableFingerprint): self
    {
        $this->dataTableFingerprint = $dataTableFingerprint;

        return $this;
    }

    /**
     * @param string $queryStringAlias
     *
     * @return self
     */
    public function setQueryStringAlias(string $queryStringAlias): self
    {
        $this->queryStringAlias = $queryStringAlias;

        return $this;
    }
}
