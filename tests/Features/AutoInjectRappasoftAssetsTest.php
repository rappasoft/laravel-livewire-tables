<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Features;

use Rappasoft\LaravelLivewireTables\Features\AutoInjectRappasoftAssets;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class AutoInjectRappasoftAssetsTest extends TestCase
{
    /** @test */
    public function shouldInjectRappasoftAndThirdParty()
    {
        config()->set('livewire-tables.inject_core_assets_enabled', true);
        config()->set('livewire-tables.inject_third_party_assets_enabled', true);

        $this->assertEquals('<html><head>    <link href="/rappasoft/laravel-livewire-tables/core.min.css" rel="stylesheet" />     <link href="/rappasoft/laravel-livewire-tables/thirdparty.css" rel="stylesheet" /><script src="/rappasoft/laravel-livewire-tables/core.min.js"   ></script> <script src="/rappasoft/laravel-livewire-tables/thirdparty.min.js"  type="module"  ></script></head><body></body></html>', AutoInjectRappasoftAssets::injectAssets('<html><head></head><body></body></html>'));
    }

    /** @test */
    public function shouldNotInjectRappasoftOrThirdParty()
    {
        config()->set('livewire-tables.inject_core_assets_enabled', false);
        config()->set('livewire-tables.inject_third_party_assets_enabled', false);

        $this->assertEquals('<html><head>  </head><body></body></html>', AutoInjectRappasoftAssets::injectAssets('<html><head></head><body></body></html>'));
    }

    /** @test */
    public function shouldOnlyInjectThirdParty()
    {
        config()->set('livewire-tables.inject_core_assets_enabled', false);
        config()->set('livewire-tables.inject_third_party_assets_enabled', true);

        $this->assertEquals('<html><head>     <link href="/rappasoft/laravel-livewire-tables/thirdparty.css" rel="stylesheet" /> <script src="/rappasoft/laravel-livewire-tables/thirdparty.min.js"  type="module"  ></script></head><body></body></html>', AutoInjectRappasoftAssets::injectAssets('<html><head></head><body></body></html>'));
    }

    /** @test */
    public function shouldOnlyInjectRappasoft()
    {
        config()->set('livewire-tables.inject_core_assets_enabled', true);
        config()->set('livewire-tables.inject_third_party_assets_enabled', false);

        $this->assertEquals('<html><head>    <link href="/rappasoft/laravel-livewire-tables/core.min.css" rel="stylesheet" /> <script src="/rappasoft/laravel-livewire-tables/core.min.js"   ></script> </head><body></body></html>', AutoInjectRappasoftAssets::injectAssets('<html><head></head><body></body></html>'));
    }
}
