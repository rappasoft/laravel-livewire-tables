<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait TableAttributeConfiguration
{
    /**
     * Get a list of attributes to override on the main wrapper of the component
     *
     * @param  array<mixed>  $attributes
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
     */
    public function setTableAttributes(array $attributes = []): self
    {
        $this->tableAttributes = [...['id' => 'table-'.$this->getTableName()], ...$attributes];

        return $this;
    }

    /**
     * Set a list of attributes to override on the thead element
     *
     * @param  array<mixed>  $attributes
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
     */
    public function setTbodyAttributes(array $attributes = []): self
    {
        $this->tbodyAttributes = $attributes;

        return $this;
    }

    /**
     * Set a list of attributes to override on the th elements
     */
    public function setThAttributes(callable $callback): self
    {
        $this->thAttributesCallback = $callback;

        return $this;
    }

    /**
     * Set a list of attributes to override on the th sort button elements
     */
    public function setThSortButtonAttributes(callable $callback): self
    {
        $this->thSortButtonAttributesCallback = $callback;

        return $this;
    }

    /**
     * Set a list of attributes to override on the td elements
     */
    public function setTrAttributes(callable $callback): self
    {
        $this->trAttributesCallback = $callback;

        return $this;
    }

    /**
     * Set a list of attributes to override on the td elements
     */
    public function setTdAttributes(callable $callback): self
    {
        $this->tdAttributesCallback = $callback;

        return $this;
    }

    public function setTableRowUrl(callable $callback): self
    {
        $this->trUrlCallback = $callback;

        return $this;
    }

    public function setTableRowUrlTarget(callable $callback): self
    {
        $this->trUrlTargetCallback = $callback;

        return $this;
    }
}
