<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\Filters;

trait HandlesFilterTraits
{
    use ManagesFilters,
        HasFilterGenericData,
        HasFilterMenuStyling,
        HasFilterPillsStyling,
        HasFilterQueryString,
        HasFiltersStatus,
        HasFiltersVisibility;
}
