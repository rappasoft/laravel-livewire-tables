<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Support\Arr;

/**
 * Trait Options.
 */
trait Options
{
    /**
     * @var array
     */
    protected $options = [
        'bootstrap' => [
            'classes' => [
                'table' => 'table table-bordered table-striped',
            ],
            'container' => true,
            'responsive' => true,
        ],
    ];

    /**
     * @param $option
     *
     * @return mixed
     */
    public function getOption($option)
    {
        return Arr::dot($this->options)[$option] ?? null;
    }

    /**
     * @param  array  $overrides
     */
    protected function setOptions(array $overrides = []): void
    {
        foreach ($overrides as $key => $value) {
            data_set($this->options, $key, $value);
        }
    }
}
