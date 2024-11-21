<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Features;

use Rappasoft\LaravelLivewireTables\Features\AutoInjectRappasoftAssets;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class AutoInjectRappasoftAssetsTest extends TestCase
{
    public function test_should_inject_rappasoft_and_third_party()
    {
        config()->set('livewire-tables.inject_core_assets_enabled', true);
        config()->set('livewire-tables.inject_third_party_assets_enabled', true);

        $injectionReturn = AutoInjectRappasoftAssets::injectAssets('<html><head></head><body></body></html>');

        $this->assertStringContainsStringIgnoringCase('<link href="/rappasoft/laravel-livewire-tables/core.min.css" rel="stylesheet" />', $injectionReturn);
        $this->assertStringContainsStringIgnoringCase('<script src="/rappasoft/laravel-livewire-tables/core.min.js"  ></script>', $injectionReturn);
        $this->assertStringContainsStringIgnoringCase('<link href="/rappasoft/laravel-livewire-tables/thirdparty.css" rel="stylesheet" />', $injectionReturn);
        $this->assertStringContainsStringIgnoringCase('<script src="/rappasoft/laravel-livewire-tables/thirdparty.min.js"  ></script>', $injectionReturn);
    }

    public function test_should_not_inject_rappasoft_or_third_party()
    {
        config()->set('livewire-tables.inject_core_assets_enabled', false);
        config()->set('livewire-tables.inject_third_party_assets_enabled', false);

        $injectionReturn = AutoInjectRappasoftAssets::injectAssets('<html><head></head><body></body></html>');

        $this->assertEquals('<html><head>  </head><body></body></html>', AutoInjectRappasoftAssets::injectAssets('<html><head></head><body></body></html>'));
    }

    public function test_should_only_inject_third_party()
    {
        config()->set('livewire-tables.inject_core_assets_enabled', false);
        config()->set('livewire-tables.inject_third_party_assets_enabled', true);

        $injectionReturn = AutoInjectRappasoftAssets::injectAssets('<html><head></head><body></body></html>');

        $this->assertStringContainsStringIgnoringCase('<link href="/rappasoft/laravel-livewire-tables/thirdparty.css" rel="stylesheet" />', $injectionReturn);
        $this->assertStringContainsStringIgnoringCase('<script src="/rappasoft/laravel-livewire-tables/thirdparty.min.js"  ></script>', $injectionReturn);
    }

    public function test_should_only_inject_rappasoft()
    {
        config()->set('livewire-tables.inject_core_assets_enabled', true);
        config()->set('livewire-tables.inject_third_party_assets_enabled', false);

        $injectionReturn = AutoInjectRappasoftAssets::injectAssets('<html><head></head><body></body></html>');

        $this->assertStringContainsStringIgnoringCase('<link href="/rappasoft/laravel-livewire-tables/core.min.css" rel="stylesheet" />', $injectionReturn);
        $this->assertStringContainsStringIgnoringCase('<script src="/rappasoft/laravel-livewire-tables/core.min.js"  ></script>', $injectionReturn);

    }
}
