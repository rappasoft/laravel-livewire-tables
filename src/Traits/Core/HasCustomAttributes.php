<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core;

use Illuminate\View\ComponentAttributeBag;

trait HasCustomAttributes
{
    public function hasCustomAttributes(string $propertyName): bool
    {
        return property_exists($this, $propertyName) && isset($this->{$propertyName});
    }

    public function getCustomAttributes(string $propertyName, bool $default = false, bool $classicMode = true): array
    {
        if ($classicMode) {
            if ($this->hasCustomAttributes($propertyName)) {
                $vals = array_merge(['default' => $default, 'default-colors' => $default, 'default-styling' => $default], $this->{$propertyName});
                ksort($vals);

                return $vals;
            }

            return ['default' => $default, 'default-colors' => $default, 'default-styling' => $default];
        } else {
            if ($this->hasCustomAttributes($propertyName)) {
                $vals = array_merge(['default-colors' => $default, 'default-styling' => $default], $this->{$propertyName});
                ksort($vals);

                return $vals;
            }

            return ['default-colors' => $default, 'default-styling' => $default];

        }
    }

    public function getCustomAttributesBag(string $propertyName): ComponentAttributeBag
    {
        return new ComponentAttributeBag($this->getCustomAttributes($propertyName));
    }

    public function setCustomAttributes(string $propertyName, array $customAttributes): self
    {
        $this->{$propertyName} = $customAttributes;

        return $this;
    }

    public function getCustomAttributesBagFromArray(array $attributesArray): ComponentAttributeBag
    {
        return new ComponentAttributeBag($attributesArray);
    }
}
