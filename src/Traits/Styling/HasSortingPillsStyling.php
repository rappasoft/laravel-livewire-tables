<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration\SortingPillsStylingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers\SortingPillsStylingHelpers;

trait HasSortingPillsStyling
{
    use SortingPillsStylingConfiguration,
        SortingPillsStylingHelpers;

    protected array $sortingPillsItemAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

    protected array $sortingPillsClearSortButtonAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

    protected array $sortingPillsClearAllButtonAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];
}
