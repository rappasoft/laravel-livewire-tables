<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Visuals;

use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTableLazyPlaceholder;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTableLazyPlaceholderCustomView;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTableLazyPlaceholderDisabled;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

#[Group('Visuals')]
final class LazyPlaceholderVisualsTest extends TestCase
{
    public function test_placeholder_method_returns_view(): void
    {
        $table = new PetsTableLazyPlaceholder;
        $table->bootAll();

        $placeholder = $table->placeholder();

        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $placeholder);
    }

    public function test_placeholder_renders_x_data_with_alpine_fallback_variables(): void
    {
        $table = new PetsTableLazyPlaceholder;
        $table->bootAll();

        $placeholder = $table->placeholder();
        $html = $placeholder->render();

        $this->assertStringContainsString('x-data=', $html);
        $this->assertStringContainsString('currentlyReorderingStatus', $html);
        $this->assertStringContainsString('paginationTotalItemCount', $html);
        $this->assertStringContainsString('selectedItems', $html);
        $this->assertStringContainsString('filtersOpen', $html);
    }

    public function test_placeholder_renders_default_skeleton_when_enabled(): void
    {
        $table = new PetsTableLazyPlaceholder;
        $table->bootAll();

        $placeholder = $table->placeholder();
        $html = $placeholder->render();

        $this->assertStringContainsString('role="status"', $html);
        $this->assertStringContainsString('aria-label="Loading table data..."', $html);
    }

    public function test_placeholder_renders_empty_wrapper_when_disabled(): void
    {
        $table = new PetsTableLazyPlaceholderDisabled;
        $table->bootAll();

        $placeholder = $table->placeholder();
        $html = $placeholder->render();

        $this->assertStringContainsString('x-data=', $html);
        $this->assertStringNotContainsString('role="status"', $html);
    }

    public function test_placeholder_renders_custom_view_inside_wrapper(): void
    {
        $table = new PetsTableLazyPlaceholderCustomView;
        $table->bootAll();

        $placeholder = $table->placeholder();
        $html = $placeholder->render();

        $this->assertStringContainsString('x-data=', $html);
        $this->assertStringContainsString('test', $html);
    }

    public function test_placeholder_always_has_x_data_regardless_of_status(): void
    {
        $enabledTable = new PetsTableLazyPlaceholder;
        $enabledTable->bootAll();

        $disabledTable = new PetsTableLazyPlaceholderDisabled;
        $disabledTable->bootAll();

        $enabledHtml = $enabledTable->placeholder()->render();
        $disabledHtml = $disabledTable->placeholder()->render();

        $this->assertStringContainsString('x-data=', $enabledHtml);
        $this->assertStringContainsString('x-data=', $disabledHtml);
    }

    public function test_placeholder_passes_theme_variables(): void
    {
        $table = new PetsTableLazyPlaceholder;
        $table->bootAll();

        $placeholder = $table->placeholder();
        $data = $placeholder->getData();

        $this->assertArrayHasKey('isTailwind', $data);
        $this->assertArrayHasKey('isBootstrap', $data);
        $this->assertArrayHasKey('isBootstrap4', $data);
        $this->assertArrayHasKey('isBootstrap5', $data);
    }

    public function test_default_table_has_placeholder_method(): void
    {
        $table = new PetsTable;
        $table->bootAll();

        $this->assertTrue(method_exists($table, 'placeholder'));

        $placeholder = $table->placeholder();

        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $placeholder);
    }

    public function test_placeholder_content_is_null_when_disabled(): void
    {
        $table = new PetsTableLazyPlaceholderDisabled;
        $table->bootAll();

        $placeholder = $table->placeholder();
        $data = $placeholder->getData();

        $this->assertNull($data['lazyPlaceholderContent']);
    }

    public function test_placeholder_content_is_default_view_when_enabled(): void
    {
        $table = new PetsTableLazyPlaceholder;
        $table->bootAll();

        $placeholder = $table->placeholder();
        $data = $placeholder->getData();

        $this->assertSame('livewire-tables::lazy-placeholder-content', $data['lazyPlaceholderContent']);
    }

    public function test_placeholder_content_is_custom_view_when_set(): void
    {
        $table = new PetsTableLazyPlaceholderCustomView;
        $table->bootAll();

        $placeholder = $table->placeholder();
        $data = $placeholder->getData();

        $this->assertSame('livewire-tables-test::test', $data['lazyPlaceholderContent']);
    }
}
