<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Illuminate\View\ComponentAttributeBag;
use Rappasoft\LaravelLivewireTables\Traits\Core\HasCustomAttributes;

trait HasLabelAttributes
{
    use HasCustomAttributes;

    protected ?array $labelAttributesArray;

    public function hasLabelAttributes(): bool
    {
        return $this->hasCustomAttributes('labelAttributesArray');
    }

    /**
     * Used in resources/views/components/table/th.blade.php
     */
    public function getLabelAttributes(): array
    {
        return $this->getCustomAttributes('labelAttributesArray');
    }

    public function getLabelAttributesBag(): ComponentAttributeBag
    {
        return new ComponentAttributeBag($this->getLabelAttributes());
    }

    /**
     * Set a list of attributes to override on the th label
     */
    public function setLabelAttributes(array $labelAttributes): self
    {
        $this->setCustomAttributes('labelAttributesArray', $labelAttributes);

        return $this;
    }
}
