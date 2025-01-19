<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters\Styling\Configuration;

trait FilterPillsStylingConfiguration
{
    protected function setFilterPillsItemAttributes(array $attributes = []): self
    {
        return $this->mergeCustomAttributes(propertyName: 'filterPillsItemAttributes', customAttributes: $attributes);
    }

    protected function setFilterPillsResetFilterButtonAttributes(array $attributes = []): self
    {
        return $this->mergeCustomAttributes(propertyName: 'filterPillsResetFilterButtonAttributes', customAttributes: $attributes);
    }

    protected function setFilterPillsResetAllButtonAttributes(array $attributes = []): self
    {
        return $this->mergeCustomAttributes(propertyName: 'filterPillsResetAllButtonAttributes', customAttributes: $attributes);
    }
}
