<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Views\Filter;

trait FilterConfiguration
{
    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    public function config(array $config = []): Filter
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function setFilterPillTitle(string $title): self
    {
        $this->filterPillTitle = $title;

        return $this;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function setFilterPillValues(array $values): self
    {
        $this->filterPillValues = $values;

        return $this;
    }

    /**
     * @return mixed
     */
     public function hidden(): self
     {
         $this->hidden = true;

         return $this;
     }
}
