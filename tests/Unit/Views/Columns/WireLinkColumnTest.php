<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Views\Columns;

use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Views\Columns\WireLinkColumn;

#[Group('Columns')]
class WireLinkColumnTest extends ColumnTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::$columnInstance = WireLinkColumn::make('Name', 'name');
    }

    public function test_can_not_infer_field_name_from_title_if_no_from(): void
    {
        $column = WireLinkColumn::make('My Title');

        $this->assertNull($column->getField());
    }

    public function test_can_not_render_field_if_no_title_callback(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        WireLinkColumn::make('Name')->getContents(Pet::find(1));
    }

    public function test_can_not_render_field_if_no_action_callback(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        WireLinkColumn::make('Name')->title(fn ($row) => 'Edit')->getContents(Pet::find(1));
    }

    public function test_can_render_field_if_title_and_action_callback(): void
    {
        $column = WireLinkColumn::make('Name')->title(fn ($row) => 'Edit')->action(fn ($row) => 'delete("'.$row->id.'")')->getContents(Pet::find(1));

        $this->assertNotEmpty($column);
    }

    public function test_can_render_field_if_confirm_set(): void
    {
        $column = WireLinkColumn::make('Name')->title(fn ($row) => 'Edit')->action(fn ($row) => 'delete("'.$row->id.'")')->confirmMessage('Test')->getContents(Pet::find(1));

        $this->assertNotEmpty($column);
    }

    public function test_can_add_confirm_message(): void
    {
        $this->assertFalse(self::$columnInstance->hasConfirmMessage());

        self::$columnInstance->confirmMessage('Test');

        $this->assertTrue(self::$columnInstance->hasConfirmMessage());

        $this->assertSame('Test', self::$columnInstance->getConfirmMessage());
    }
}
