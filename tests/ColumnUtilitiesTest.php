<?php

namespace Rappasoft\LaravelLivewireTables\Tests;

use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Utilities\ColumnUtilities;

class ColumnUtilitiesTest extends TestCase
{
    protected $query;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function test_parse_relation(): void
    {
        $this->assertFalse(ColumnUtilities::hasRelation('id'));
        $this->assertTrue(ColumnUtilities::hasRelation('pets.id'));
        $this->assertEquals('pets', ColumnUtilities::parseRelation('pets.id'));
        $this->assertEquals('pets.breeds', ColumnUtilities::parseRelation('pets.breeds.id'));
    }

    /** @test */
    public function test_parse_field(): void
    {
        $this->assertEquals('id', ColumnUtilities::parseField('pets.id'));
    }

    /** @test */
    public function test_has_match(): void
    {
        $this->assertTrue(ColumnUtilities::hasMatch('id', ['id', 'name']));
        $this->assertTrue(ColumnUtilities::hasMatch('name', ['id', 'name']));
    }

    /** @test */
    public function test_has_wildcard_match(): void
    {
        $this->assertTrue(ColumnUtilities::hasWildcardMatch('id', ['*']));
        $this->assertTrue(ColumnUtilities::hasWildcardMatch('pets.id', ['pets.*']));
    }

    /** @test */
    public function test_get_columns(): void
    {
        $query = Pet::query();
        $this->assertIsNotArray(ColumnUtilities::columnsFromBuilder($query));
        $query->select('id', 'name');
        $this->assertIsArray(ColumnUtilities::columnsFromBuilder($query));
        $this->assertCount(2, ColumnUtilities::columnsFromBuilder($query));
        $this->assertEquals(['id', 'name',], ColumnUtilities::columnsFromBuilder($query));
    }

    /** @test */
    public function test_map(): void
    {
        // simple match
        $query = Pet::query()->select('id');
        $this->assertEquals('id', ColumnUtilities::mapToSelected('id', $query));

        // wildcard match
        $query = Pet::query()->select('*');
        $this->assertEquals('id', ColumnUtilities::mapToSelected('id', $query));

        // alias match
        $query = Pet::query()->select('pets.id');
        $this->assertEquals('pets.id', ColumnUtilities::mapToSelected('pets.id', $query));

        // alias wildcard match
        $query = Pet::query()->select('pets.*');
        $this->assertEquals('pets.id', ColumnUtilities::mapToSelected('pets.id', $query));

        // join relation wildcard match
        $query = Pet::query()->select('breeds.*')->join('breeds', 'pets.breeds_id', '=', 'breeds.id');
        $this->assertEquals('breeds.id', ColumnUtilities::mapToSelected('breeds.id', $query));
        // using relation only
        $this->assertEquals('breeds.id', ColumnUtilities::mapToSelected('breed.id', $query));
    }
}
