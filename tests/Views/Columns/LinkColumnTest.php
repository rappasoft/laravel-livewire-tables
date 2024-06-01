<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Views\Columns;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

final class LinkColumnTest extends TestCase
{
    public function test_can_set_the_column_title(): void
    {
        $column = LinkColumn::make('Name', 'name');

        $this->assertSame('Name', $column->getTitle());
    }

    public function test_can_not_infer_field_name_from_title_if_no_from(): void
    {
        $column = LinkColumn::make('My Title');

        $this->assertNull($column->getField());
    }

    public function test_can_not_render_field_if_no_title_callback(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        LinkColumn::make('Name')->getContents(Pet::find(1));
    }

    public function test_can_not_render_field_if_no_location_callback(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        LinkColumn::make('Name')->title(fn ($row) => 'Edit')->getContents(Pet::find(1));
    }

    public function test_can_render_field_if_title_and_location_callback(): void
    {
        $column = LinkColumn::make('Name')->title(fn ($row) => 'Edit')->location(fn ($row) => 'test'.$row->id)->getContents(Pet::find(1));

        $this->assertNotEmpty($column);
    }

    /** @test */
    public function can_check_ishtml_from_html_column(): void
    {
        $column = LinkColumn::make('Name', 'name')
            ->title(fn ($row) => 'Title')
            ->location(fn ($row) => "#$row->id")
            ->html();

        $this->assertTrue($column->isHtml());
    }

    /** @test */
    public function can_get_html_from_html_label_column(): void
    {
        $column = LinkColumn::make('Name', 'name')
            ->title(fn ($row) => '<strong>My Label</strong>')
            ->location(fn ($row) => "#$row->id")
            ->html();

        $rows = $this->basicTable->getRows();
        $location = '#'.$rows->first()->id;
        $htmlString = new \Illuminate\Support\HtmlString('<a href="'.$location.'"><strong>My Label</strong></a>');

        // Removing every whitespace and line break for the comparison
        $expectedHtml = preg_replace('/\s+/', '', $htmlString->toHtml());
        $actualHtml = preg_replace('/\s+/', '', $column->getContents($rows->first())->toHtml());

        $this->assertSame($expectedHtml, $actualHtml);
    }
}
