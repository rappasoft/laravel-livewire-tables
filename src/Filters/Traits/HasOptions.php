<?php

namespace Rappasoft\LaravelLivewireTables\Filters\Traits;

trait HasOptions
{
    public $options = [];

    /**
     * @param string $key
     * @param $value
     * @return self
     */
    public function addOption(string $key, $value): self
    {
        $this->options[$key] = $value;

        return $this;
    }

    /**
     * @param $options array|\Illuminate\Support\Collection
     * @return self
     */
    public function withOptions($options): HasOptions
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return array|\Illuminate\Support\Collection
     */
    public function options()
    {
        return $this->options;
    }
}
