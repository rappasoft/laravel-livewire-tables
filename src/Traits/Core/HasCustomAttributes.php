<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core;

use Illuminate\View\ComponentAttributeBag;

trait HasCustomAttributes
{
    public function hasCustomAttributes(string $propertyName): bool
    {
        return isset($this->{$propertyName});
    }

    public function getCustomAttributes(string $propertyName, bool $default = false, bool $classicMode = true): array
    {
        if ($classicMode)
        {
            if ($this->hasCustomAttributes($propertyName))
            {
                $vals = array_merge(['default' => $default, 'default-colors' => $default, 'default-styling' => $default], $this->{$propertyName});
                ksort($vals);
                return $vals;
            } 
            return ['default' => true, 'default-colors' => true, 'default-styling' => true];
        }
        else
        {
            if ($this->hasCustomAttributes($propertyName))
            {
                $vals = array_merge(['default-colors' => $default, 'default-styling' => $default], $this->{$propertyName});
                ksort($vals);
                return $vals;
            } 
            return ['default-colors' => true, 'default-styling' => true];
    
        }
    }

    public function getCustomAttributesBag(string $propertyName): ComponentAttributeBag
    {
        return new ComponentAttributeBag($this->getCustomAttributes($propertyName));
    }

    public function setCustomAttributes(string $propertyName,array $customAttributes): self
    {
        $this->{$propertyName} = $customAttributes;

        return $this;
    }


}