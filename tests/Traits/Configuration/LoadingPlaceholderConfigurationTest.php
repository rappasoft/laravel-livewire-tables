<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class LoadingPlaceholderConfigurationTest extends TestCase
{
    public function test_can_set_loading_placeholder_status_enabled(): void
    {
        $this->assertFalse($this->basicTable->hasDisplayLoadingPlaceholder());

        $this->basicTable->setLoadingPlaceholderEnabled();

        $this->assertTrue($this->basicTable->hasDisplayLoadingPlaceholder());

    }

    public function test_can_set_loading_placeholder_status_disabled(): void
    {
        $this->assertFalse($this->basicTable->hasDisplayLoadingPlaceholder());

        $this->basicTable->setLoadingPlaceholderEnabled();

        $this->assertTrue($this->basicTable->hasDisplayLoadingPlaceholder());

        $this->basicTable->setLoadingPlaceholderDisabled();

        $this->assertFalse($this->basicTable->hasDisplayLoadingPlaceholder());

    }

    public function test_can_set_loading_placeholder_content(): void
    {
        $this->basicTable->setLoadingPlaceholderEnabled();

        $this->assertTrue($this->basicTable->hasDisplayLoadingPlaceholder());

        $this->assertSame('Loading', $this->basicTable->getLoadingPlaceholderContent());

        $this->basicTable->setLoadingPlaceholderContent('LoadingConfigurationTest - LoadingLoadingLoading');

        $this->assertSame('LoadingConfigurationTest - LoadingLoadingLoading', $this->basicTable->getLoadingPlaceholderContent());

    }

    public function test_can_set_loading_placeholder_attributes(): void
    {
        $this->basicTable->setLoadingPlaceholderEnabled();

        $this->assertSame(['default' => true], $this->basicTable->getLoadingPlaceHolderAttributes());

        $this->basicTable->setLoadingPlaceHolderAttributes(['class' => 'test12345']);

        $this->assertSame(['class' => 'test12345'], $this->basicTable->getLoadingPlaceHolderAttributes());

    }

    public function test_can_set_loading_placeholder_icon_attributes(): void
    {
        $this->basicTable->setLoadingPlaceholderEnabled();

        $this->assertSame(['default' => true], $this->basicTable->getLoadingPlaceHolderIconAttributes());

        $this->basicTable->setLoadingPlaceHolderIconAttributes(['class' => 'test123']);

        $this->assertSame(['class' => 'test123'], $this->basicTable->getLoadingPlaceHolderIconAttributes());

    }

    public function test_can_set_loading_placeholder_wrapper_attributes(): void
    {
        $this->basicTable->setLoadingPlaceholderEnabled();

        $this->assertSame(['default' => true], $this->basicTable->getLoadingPlaceHolderWrapperAttributes());

        $this->basicTable->setLoadingPlaceHolderWrapperAttributes(['class' => 'test1234567-wrapper']);

        $this->assertSame(['class' => 'test1234567-wrapper'], $this->basicTable->getLoadingPlaceHolderWrapperAttributes());
    }

    public function test_can_set_loading_placeholder_custom_blade(): void
    {
        $this->basicTable->setLoadingPlaceholderEnabled();

        $this->assertNull($this->basicTable->getLoadingPlaceHolderBlade());

        $this->basicTable->setLoadingPlaceholderBlade('test-blade');

        $this->assertSame('test-blade', $this->basicTable->getLoadingPlaceHolderBlade());
    }
}
