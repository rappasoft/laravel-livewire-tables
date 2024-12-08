<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Filters;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\LivewireComponentFilter;

final class LivewireComponentFilterTest extends FilterTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::$filterInstance = LivewireComponentFilter::make('Active');
    }

    public function test_can_get_filter_callback(): void
    {
        $filter = LivewireComponentFilter::make('Active');

        $this->assertFalse($filter->hasFilterCallback());

        $filter = LivewireComponentFilter::make('Active')
            ->filter(function (Builder $builder, int $value) {
                return $builder->where('name', '=', $value);
            });

        $this->assertTrue($filter->hasFilterCallback());
        $this->assertIsCallable($filter->getFilterCallback());
    }

    public function test_can_set_livewire_component_filter_to_text(): void
    {
        $filter = LivewireComponentFilter::make('BreedID');
        $this->assertSame('test', $filter->validate('test'));
        $this->assertSame('123', $filter->validate(123));

    }

    public function test_can_get_if_livewire_component_filter_empty(): void
    {
        $filter = LivewireComponentFilter::make('Active');
        $this->assertTrue($filter->isEmpty(null));
        $this->assertTrue($filter->isEmpty(''));
        $this->assertFalse($filter->isEmpty('123'));
        $this->assertFalse($filter->isEmpty('test'));
        $this->assertFalse($filter->isEmpty(1234));

    }
}
