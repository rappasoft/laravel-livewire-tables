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

    public function test_can_set_icon_left(): void
    {
        $this->assertFalse(self::$columnInstance->hasIconLeft());

        self::$columnInstance->setIconLeft('heroicon-o-trash');

        $this->assertTrue(self::$columnInstance->hasIconLeft());
        $this->assertSame('heroicon-o-trash', self::$columnInstance->getIconLeft());
    }

    public function test_can_set_icon_right(): void
    {
        $this->assertFalse(self::$columnInstance->hasIconRight());

        self::$columnInstance->setIconRight('heroicon-o-chevron-right');

        $this->assertTrue(self::$columnInstance->hasIconRight());
        $this->assertSame('heroicon-o-chevron-right', self::$columnInstance->getIconRight());
    }

    public function test_set_icon_is_alias_for_set_icon_right(): void
    {
        $this->assertFalse(self::$columnInstance->hasIconRight());

        self::$columnInstance->setIcon('heroicon-o-check-circle');

        $this->assertTrue(self::$columnInstance->hasIconRight());
        $this->assertSame('heroicon-o-check-circle', self::$columnInstance->getIconRight());
    }

    public function test_can_set_both_icons(): void
    {
        self::$columnInstance->setIconLeft('heroicon-o-trash');
        self::$columnInstance->setIconRight('heroicon-o-chevron-right');

        $this->assertTrue(self::$columnInstance->hasIconLeft());
        $this->assertTrue(self::$columnInstance->hasIconRight());
        $this->assertTrue(self::$columnInstance->hasIcon());
        $this->assertSame('heroicon-o-trash', self::$columnInstance->getIconLeft());
        $this->assertSame('heroicon-o-chevron-right', self::$columnInstance->getIconRight());
    }

    public function test_has_icon_returns_true_if_either_icon_is_set(): void
    {
        $this->assertFalse(self::$columnInstance->hasIcon());

        self::$columnInstance->setIconLeft('heroicon-o-trash');
        $this->assertTrue(self::$columnInstance->hasIcon());

        $column2 = WireLinkColumn::make('Test', 'name');
        $column2->setIconRight('heroicon-o-check');
        $this->assertTrue($column2->hasIcon());
    }

    public function test_can_set_icon_left_attributes(): void
    {
        self::$columnInstance->setIconLeftAttributes(['class' => 'w-4 h-4 mr-2']);

        $attributes = self::$columnInstance->getIconLeftAttributes();
        $this->assertSame('w-4 h-4 mr-2', $attributes->get('class'));
    }

    public function test_can_set_icon_right_attributes(): void
    {
        self::$columnInstance->setIconRightAttributes(['class' => 'w-4 h-4 ml-2']);

        $attributes = self::$columnInstance->getIconRightAttributes();
        $this->assertSame('w-4 h-4 ml-2', $attributes->get('class'));
    }

    public function test_can_set_icon_attributes_for_both(): void
    {
        self::$columnInstance->setIconAttributes(['class' => 'w-5 h-5']);

        $leftAttributes = self::$columnInstance->getIconLeftAttributes();
        $rightAttributes = self::$columnInstance->getIconRightAttributes();

        $this->assertSame('w-5 h-5', $leftAttributes->get('class'));
        $this->assertSame('w-5 h-5', $rightAttributes->get('class'));
    }

    public function test_can_render_field_with_icon(): void
    {
        $column = WireLinkColumn::make('Name')
            ->title(fn ($row) => 'Delete')
            ->action(fn ($row) => 'delete("'.$row->id.'")')
            ->setIconLeft('heroicon-o-trash');

        $contents = $column->getContents(Pet::find(1));

        $this->assertNotEmpty($contents);
    }

    public function test_can_render_field_with_both_icons(): void
    {
        $column = WireLinkColumn::make('Name')
            ->title(fn ($row) => 'View')
            ->action(fn ($row) => 'view("'.$row->id.'")')
            ->setIconLeft('heroicon-o-eye')
            ->setIconRight('heroicon-o-chevron-right');

        $contents = $column->getContents(Pet::find(1));

        $this->assertNotEmpty($contents);
    }
}
