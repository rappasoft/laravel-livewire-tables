<?php

declare(strict_types=1);

namespace Rappasoft\LaravelLivewireTables\Concerns;

/**
 * Trait for managing HTML attributes with defaults
 */
trait HasAttributes
{
    /**
     * Merge attributes with defaults, handling 'default' key specially
     *
     * @param array<string, mixed> $defaults
     * @param array<string, mixed> $attributes
     * @return array<string, mixed>
     */
    protected function mergeAttributes(array $defaults, array $attributes): array
    {
        // If default key exists and is false, only use provided attributes
        if (isset($attributes['default']) && $attributes['default'] === false) {
            unset($attributes['default']);
            return $attributes;
        }

        // Remove default key before merging
        unset($attributes['default']);
        unset($defaults['default']);

        return [...$defaults, ...$attributes];
    }

    /**
     * Build a CSS class string from an array of classes
     *
     * @param array<int|string, string|bool> $classes
     * @return string
     */
    protected function buildClassString(array $classes): string
    {
        $result = [];

        foreach ($classes as $key => $value) {
            if (is_int($key) && is_string($value)) {
                // Simple class: ['class1', 'class2']
                $result[] = $value;
            } elseif (is_string($key) && $value === true) {
                // Conditional class: ['class1' => true, 'class2' => false]
                $result[] = $key;
            }
        }

        return implode(' ', array_filter($result));
    }
}

