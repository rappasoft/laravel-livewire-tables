<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Filters;

use Illuminate\Database\Eloquent\Builder;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

#[Group('Filters')]
final class TextFilterTest extends FilterTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::$filterInstance = TextFilter::make('Active');
        self::$extraFilterInputAttributes = [
            'maxlength' => null,
            'placeholder' => null,
            'type' => 'text',
            'wire:key' => 'test123-filter-text-active',
        ];
    }

    public function test_can_get_filter_callback(): void
    {
        $filter = TextFilter::make('Active');

        $this->assertFalse($filter->hasFilterCallback());

        $filter = TextFilter::make('Active')
            ->filter(function (Builder $builder, int $value) {
                return $builder->where('name', '=', $value);
            });

        $this->assertTrue($filter->hasFilterCallback());
        $this->assertIsCallable($filter->getFilterCallback());
    }

    public function test_can_not_exceed_text_filter_max_length(): void
    {
        $filter = TextFilter::make('BreedID')->config(['maxlength' => 10]);
        $this->assertFalse($filter->validate('testtesttesttesttest'));
    }

    public function test_can_set_text_filter_to_number(): void
    {
        $filter = TextFilter::make('BreedID');
        $this->assertSame('123', $filter->validate(123));
        $this->assertSame('123', $filter->validate('123'));
    }

    public function test_can_set_text_filter_to_text(): void
    {
        $filter = TextFilter::make('BreedID');
        $this->assertSame('test', $filter->validate('test'));
    }

    public function test_can_get_if_text_filter_empty(): void
    {
        $filter = TextFilter::make('Active');
        $this->assertTrue($filter->isEmpty(''));
        $this->assertFalse($filter->isEmpty('123'));
        $this->assertFalse($filter->isEmpty('test'));
    }

    public function test_can_set_custom_filter_view(): void
    {
        $filter = TextFilter::make('Active');

        $this->assertSame('livewire-tables::components.tools.filters.text-field', $filter->getViewPath());
        $filter->setCustomView('test-custom-filter-view');
        $this->assertSame('test-custom-filter-view', $filter->getViewPath());
    }

    public function test_can_set_text_filter_wireable_live(): void
    {
        $filter = TextFilter::make('Active');

        $this->assertSame('blur', $filter->getWireableMethod());

        $this->assertSame('wire:model.blur="filterComponents.active"', $filter->getWireMethod('filterComponents.'.$filter->getKey()));

        $filter->setWireLive();

        $this->assertSame('live', $filter->getWireableMethod());
        $this->assertSame('wire:model.live="filterComponents.active"', $filter->getWireMethod('filterComponents.'.$filter->getKey()));

        $filter->setWireDefer();

        $this->assertSame('defer', $filter->getWireableMethod());
        $this->assertSame('wire:model="filterComponents.active"', $filter->getWireMethod('filterComponents.'.$filter->getKey()));

        $filter->setWireBlur();

        $this->assertSame('blur', $filter->getWireableMethod());

        $this->assertSame('wire:model.blur="filterComponents.active"', $filter->getWireMethod('filterComponents.'.$filter->getKey()));

        $filter->setWireDebounce(250);

        $this->assertSame('live.debounce.250ms', $filter->getWireableMethod());
        $this->assertSame('wire:model.live.debounce.250ms="filterComponents.active"', $filter->getWireMethod('filterComponents.'.$filter->getKey()));

        $filter->setWireDebounce(500);

        $this->assertSame('live.debounce.500ms', $filter->getWireableMethod());
        $this->assertSame('wire:model.live.debounce.500ms="filterComponents.active"', $filter->getWireMethod('filterComponents.'.$filter->getKey()));

    }

    public function test_has_field_name(): void
    {
        $filter = TextFilter::make('BreedID');
        $this->assertFalse($filter->hasFieldName());

        $filter->setFieldName('breed_id');
        $this->assertTrue($filter->hasFieldName());

    }

    public function test_get_field_name(): void
    {
        $filter = TextFilter::make('BreedID');
        $this->assertFalse($filter->hasFieldName());

        $filter->setFieldName('breed_id');
        $this->assertTrue($filter->hasFieldName());
        $this->assertSame('breed_id', $filter->getFieldName());
    }
}
