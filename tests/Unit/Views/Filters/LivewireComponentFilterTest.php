<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Filters;

use Illuminate\Database\Eloquent\Builder;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Views\Filters\LivewireComponentFilter;

#[Group('Filters')]
final class LivewireComponentFilterTest extends FilterTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::$filterInstance = LivewireComponentFilter::make('Active');
    }

    public function test_can_get_filter_callback(): void
    {
        $this->assertFalse(self::$filterInstance->hasFilterCallback());

        self::$filterInstance
            ->filter(function (Builder $builder, int $value) {
                return $builder->where('name', '=', $value);
            });

        $this->assertTrue(self::$filterInstance->hasFilterCallback());
        $this->assertIsCallable(self::$filterInstance->getFilterCallback());
    }

    public function test_can_set_livewire_component_filter_to_text(): void
    {
        $this->assertSame('test', self::$filterInstance->validate('test'));
        $this->assertSame('123', self::$filterInstance->validate(123));

    }

    public function test_can_get_if_livewire_component_filter_empty(): void
    {
        $this->assertTrue(self::$filterInstance->isEmpty(null));
        $this->assertTrue(self::$filterInstance->isEmpty(''));
        $this->assertFalse(self::$filterInstance->isEmpty('123'));
        $this->assertFalse(self::$filterInstance->isEmpty('test'));
        $this->assertFalse(self::$filterInstance->isEmpty(1234));

    }
}
