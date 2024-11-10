<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class PaginationHelpersTest extends TestCase
{
    public function test_can_get_pagination_status(): void
    {
        $this->assertTrue($this->basicTable->paginationIsEnabled());

        $this->basicTable->setPaginationDisabled();

        $this->assertTrue($this->basicTable->paginationIsDisabled());

        $this->basicTable->setPaginationEnabled();

        $this->assertTrue($this->basicTable->paginationIsEnabled());
    }

    public function test_can_get_pagination_visibility_status(): void
    {
        $this->assertTrue($this->basicTable->paginationVisibilityIsEnabled());

        $this->basicTable->setPaginationVisibilityDisabled();

        $this->assertTrue($this->basicTable->paginationVisibilityIsDisabled());

        $this->basicTable->setPaginationVisibilityEnabled();

        $this->assertTrue($this->basicTable->paginationVisibilityIsEnabled());
    }

    public function test_can_get_computed_page_name(): void
    {
        $this->assertSame('page', $this->basicTable->getComputedPageName());

        $this->basicTable->setTableName('users');

        $this->assertSame('usersPage', $this->basicTable->getComputedPageName());

        $this->basicTable->setPageName('newPage');

        $this->assertSame('newPage', $this->basicTable->getComputedPageName());
    }

    public function test_can_get_per_page_selection(): void
    {
        $this->assertSame(10, $this->basicTable->getPerPage());
    }

    public function test_can_get_per_page_accepted(): void
    {
        $this->assertSame([10, 25, 50], $this->basicTable->getPerPageAccepted());
    }

    public function test_can_get_per_page_visibility_status(): void
    {
        $this->assertTrue($this->basicTable->perPageVisibilityIsEnabled());

        $this->basicTable->setPerPageVisibilityDisabled();

        $this->assertTrue($this->basicTable->perPageVisibilityIsDisabled());

        $this->basicTable->setPerPageVisibilityEnabled();

        $this->assertTrue($this->basicTable->perPageVisibilityIsEnabled());
    }

    public function test_can_check_and_set_pagination_method(): void
    {
        $this->assertTrue($this->basicTable->isPaginationMethod('standard'));

        $this->basicTable->setPaginationMethod('simple');

        $this->assertTrue($this->basicTable->isPaginationMethod('simple'));

        $this->basicTable->setPaginationMethod('standard');

        $this->assertTrue($this->basicTable->isPaginationMethod('standard'));
    }

    public function test_can_check_per_page_displayed_item_count(): void
    {
        $rows = $this->basicTable->getRows();
        $this->assertSame(5, $this->basicTable->getPerPageDisplayedItemCount());

    }

    public function test_can_check_per_page_displayed_items(): void
    {
        $rows = $this->basicTable->getRows();
        $this->assertSame([1, 2, 3, 4, 5], $this->basicTable->getPerPageDisplayedItemIds());

    }

    public function test_can_enable_detailed_pagination(): void
    {

        $this->assertTrue($this->basicTable->showPaginationDetails());

        $this->basicTable->setDisplayPaginationDetailsDisabled();

        $this->assertFalse($this->basicTable->showPaginationDetails());

        $this->basicTable->setDisplayPaginationDetailsEnabled();

        $this->assertTrue($this->basicTable->showPaginationDetails());
    }

    public function test_can_disable_detailed_pagination(): void
    {

        $this->assertTrue($this->basicTable->showPaginationDetails());

        $this->basicTable->setDisplayPaginationDetailsDisabled();

        $this->assertFalse($this->basicTable->showPaginationDetails());

    }

    public function test_can_get_pagination_field_attributes(): void
    {

        $this->assertSame(['default-styling' => true, 'default-colors' => true, 'class' => ''], $this->basicTable->getPerPageFieldAttributes());

        $this->basicTable->setPerPageFieldAttributes(
            [
                'class' => 'bg-blue-500 dark:bg-red-500',
                'default-colors' => true,
            ]
        );

        $this->assertSame(['default-styling' => true, 'default-colors' => true, 'class' => 'bg-blue-500 dark:bg-red-500'], $this->basicTable->getPerPageFieldAttributes());

        $this->basicTable->setPerPageFieldAttributes(
            [
                'default-styling' => false,
            ]
        );

        $this->assertSame(['default-styling' => false, 'default-colors' => true, 'class' => 'bg-blue-500 dark:bg-red-500'], $this->basicTable->getPerPageFieldAttributes());

    }

    public function test_can_toggle_total_item_count_retrieval(): void
    {

        $this->assertTrue($this->basicTable->getShouldRetrieveTotalItemCount());

        $this->basicTable->setShouldRetrieveTotalItemCountDisabled();

        $this->assertFalse($this->basicTable->getShouldRetrieveTotalItemCount());

        $this->basicTable->setShouldRetrieveTotalItemCountEnabled();

        $this->assertTrue($this->basicTable->getShouldRetrieveTotalItemCount());

    }

    public function test_can_toggle_total_item_count_retrieval_via_status(): void
    {

        $this->assertTrue($this->basicTable->getShouldRetrieveTotalItemCount());

        $this->basicTable->setShouldRetrieveTotalItemCountStatus(false);

        $this->assertFalse($this->basicTable->getShouldRetrieveTotalItemCount());

        $this->basicTable->setShouldRetrieveTotalItemCountStatus(true);

        $this->assertTrue($this->basicTable->getShouldRetrieveTotalItemCount());

    }

    public function test_can_get_pagination_wrapper_attributes(): void
    {

        $this->assertSame(['class' => ''], $this->basicTable->getPaginationWrapperAttributes());

        $this->basicTable->setPaginationWrapperAttributes(['class' => 'text-lg']);

        $this->assertSame(['class' => 'text-lg'], $this->basicTable->getPaginationWrapperAttributes());

        $this->basicTable->setPaginationWrapperAttributes(['class' => 'text-lg', 'testval' => '456']);

        $this->assertSame(['class' => 'text-lg', 'testval' => '456'], $this->basicTable->getPaginationWrapperAttributes());

    }

    public function test_can_get_pagination_wrapper_attributes_bag(): void
    {
        $this->assertSame((new \Illuminate\View\ComponentAttributeBag(['class' => '']))->getAttributes(), $this->basicTable->getPaginationWrapperAttributesBag()->getAttributes());

        $this->basicTable->setPaginationWrapperAttributes(['class' => 'text-lg']);

        $this->assertSame((new \Illuminate\View\ComponentAttributeBag(['class' => 'text-lg']))->getAttributes(), $this->basicTable->getPaginationWrapperAttributesBag()->getAttributes());

        $this->basicTable->setPaginationWrapperAttributes(['class' => 'text-lg', 'testval' => '123']);

        $this->assertSame((new \Illuminate\View\ComponentAttributeBag(['class' => 'text-lg', 'testval' => '123']))->getAttributes(), $this->basicTable->getPaginationWrapperAttributesBag()->getAttributes());

    }

    public function test_check_updated_per_page_returns_correctly(): void
    {
        $rows = $this->basicTable->getRows();
        $this->basicTable->setPerPageAccepted([5, 10, 15, 25, 50]);

        $this->basicTable->setPerPage(5);
        $this->assertSame(5, $this->basicTable->getPerPage());

        $this->basicTable->updatedPerPage(15);
        $this->assertSame(15, $this->basicTable->getPerPage());

    }
}
