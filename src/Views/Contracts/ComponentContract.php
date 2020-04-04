<?php

namespace Rappasoft\LaravelLivewireTables\Views\Contracts;

/**
 * Interface Component
 *
 * @package Rappasoft\LaravelLivewireTables\Views\Contracts
 */
interface ComponentContract
{

    /**
     * @return string
     */
    public function view() : string;
}
