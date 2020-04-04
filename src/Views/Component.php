<?php

namespace Rappasoft\LaravelLivewireTables\Views;

use Rappasoft\LaravelLivewireTables\Traits\CanBeHidden;
use Rappasoft\LaravelLivewireTables\Views\Contracts\ComponentContract;

/**
 * Class Clickable.
 */
abstract class Component implements ComponentContract
{
    use CanBeHidden;

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @param $attribute
     * @param $value
     *
     * @return $this
     */
    public function setAttribute($attribute, $value): self
    {
        $this->attributes[$attribute] = $value;

        return $this;
    }

    /**
     * @param  array  $attributes
     *
     * @return $this
     */
    public function setAttributes(array $attributes = []): self
    {
        $this->attributes = array_merge($this->attributes, $attributes);

        return $this;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param $option
     * @param $value
     *
     * @return $this
     */
    public function setOption($option, $value): self
    {
        $this->options[$option] = $value;

        return $this;
    }

    /**
     * @param  array  $options
     *
     * @return $this
     */
    public function setOptions(array $options = []): self
    {
        $this->options = array_merge($this->options, $options);

        return $this;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }
}
