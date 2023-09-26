<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Mechanisms;

use Rappasoft\LaravelLivewireTables\Mechanisms\RappasoftFrontendAssets;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class RappasoftFrontendAssetsTest extends TestCase
{

/**
     * @test
     */
    public function jsResponseSetupCacheDisabled(): array
    {
        config()->set('livewire-tables.cache_assets', false);
        $date = date_create();
        $assets = app(RappasoftFrontendAssets::class);
        $response = $assets->returnRappasoftTableJavaScriptAsFile();
        $this->assertIsObject($response);
        $this->assertInstanceOf(\Symfony\Component\HttpFoundation\BinaryFileResponse::class, $response);
        $this->assertInstanceOf(\Symfony\Component\HttpFoundation\ResponseHeaderBag::class, $response->headers);
        $this->assertIsIterable($response->headers->all());

        return ['lastModified' => date_timestamp_get($date), 'responseHeaders' => $response->headers->all()];
    }
    /**
     * @test
     */
    public function cssResponseSetupCacheEnabled(): array
    {
        config()->set('livewire-tables.cache_assets', true);
        $date = date_create();
        $assets = app(RappasoftFrontendAssets::class);
        $response = $assets->returnRappasoftTableStylesAsFile();
        $this->assertIsObject($response);
        $this->assertInstanceOf(\Symfony\Component\HttpFoundation\BinaryFileResponse::class, $response);
        $this->assertInstanceOf(\Symfony\Component\HttpFoundation\ResponseHeaderBag::class, $response->headers);
        $this->assertIsIterable($response->headers->all());
        return ['lastModified' => date_timestamp_get($date), 'responseHeaders' => $response->headers->all()];
    }


    /**
     * @test
     */
    public function cssResponseSetupCacheDisabled(): array
    {
        config()->set('livewire-tables.cache_assets', false);

        $date = date_create();
        
        $assets = app(RappasoftFrontendAssets::class);
        $response = $assets->returnRappasoftTableStylesAsFile();
        $this->assertIsObject($response);
        $this->assertInstanceOf(\Symfony\Component\HttpFoundation\BinaryFileResponse::class, $response);
        $this->assertInstanceOf(\Symfony\Component\HttpFoundation\ResponseHeaderBag::class, $response->headers);
        $this->assertIsIterable($response->headers->all());
        return ['lastModified' => date_timestamp_get($date), 'responseHeaders' => $response->headers->all()];
    }

    /**
     * @test
     */
    public function jsResponseSetupCacheEnabled(): array
    {
        config()->set('livewire-tables.cache_assets', true);
        $lastModified = \Carbon\Carbon::now()->timestamp;
        $assets = app(RappasoftFrontendAssets::class);
        $response = $assets->returnRappasoftTableJavaScriptAsFile();
        $this->assertIsObject($response);
        $this->assertInstanceOf(\Symfony\Component\HttpFoundation\BinaryFileResponse::class, $response);
        $this->assertInstanceOf(\Symfony\Component\HttpFoundation\ResponseHeaderBag::class, $response->headers);
        $this->assertIsIterable($response->headers->all());

        return ['lastModified' => $lastModified, 'responseHeaders' => $response->headers->all()];
    }

    
    /** @test */
    public function styles()
    {
        $assets = app(RappasoftFrontendAssets::class);

        $this->assertFalse($assets->hasRenderedRappsoftTableStyles);

        $this->assertStringStartsWith('<link href="/rappasoft/laravel-livewire-tables/core.min.css" rel="stylesheet" />', ltrim($assets->tableStyles()));

        $this->assertTrue($assets->hasRenderedRappsoftTableStyles);
    }

    /** @test */
    public function scripts()
    {
        $assets = app(RappasoftFrontendAssets::class);

        $this->assertFalse($assets->hasRenderedRappsoftTableScripts);

        $this->assertStringStartsWith('<script src="', $assets->tableScripts());

        $this->assertTrue($assets->hasRenderedRappsoftTableScripts);
    }

    /** @test */
    public function thirdPartystyles()
    {
        $assets = app(RappasoftFrontendAssets::class);

        $this->assertFalse($assets->hasRenderedRappsoftTableThirdPartyStyles);

        $this->assertStringStartsWith('<link href="/rappasoft/laravel-livewire-tables/thirdparty.css" rel="stylesheet" />', ltrim($assets->tableThirdPartyStyles()));

        $this->assertTrue($assets->hasRenderedRappsoftTableThirdPartyStyles);
    }

    /** @test */
    public function thirdPartyscripts()
    {
        $assets = app(RappasoftFrontendAssets::class);

        $this->assertFalse($assets->hasRenderedRappsoftTableThirdPartyScripts);

        $this->assertStringStartsWith('<script src="', $assets->tableThirdPartyScripts());

        $this->assertTrue($assets->hasRenderedRappsoftTableThirdPartyScripts);
    }

    /**
     * @test
     *
     * @depends jsResponseSetupCacheEnabled
     */
    public function check_pretend_response_is_js_returns_correct_cache_control_cache_enabled(array $jsResponseSetupCacheEnabled)
    {
        $this->assertSame('max-age=3600, public', $jsResponseSetupCacheEnabled['responseHeaders']['cache-control'][0]);
    }
    

    /**
     * @test
     *
     * @depends jsResponseSetupCacheEnabled
     */
    public function check_pretend_response_is_js_returns_correct_content_type_cache_enabled(array $jsResponseSetupCacheEnabled)
    {
        $this->assertSame('application/javascript; charset=utf-8', $jsResponseSetupCacheEnabled['responseHeaders']['content-type'][0]);
    }

    

    /**
     * @test
     *
     * @depends jsResponseSetupCacheDisabled
     */
    public function check_pretend_response_is_js_returns_correct_cache_control_cache_disabled(array $jsResponseSetupCacheDisabled)
    {
        $this->assertSame('max-age=1, public', $jsResponseSetupCacheDisabled['responseHeaders']['cache-control'][0]);
    }
    

    /**
     * @test
     *
     * @depends jsResponseSetupCacheDisabled
     */
    public function check_pretend_response_is_js_returns_correct_content_type_cache_disabled(array $jsResponseSetupCacheDisabled)
    {
        $this->assertSame('application/javascript; charset=utf-8', $jsResponseSetupCacheDisabled['responseHeaders']['content-type'][0]);
    }

    /**
     * @test
     *
     * @depends cssResponseSetupCacheEnabled
     */
    public function check_pretend_response_is_css_returns_correct_cache_control_caching_enabled(array $cssResponseSetupCacheEnabled)
    {
        $this->assertSame('max-age=3600, public', $cssResponseSetupCacheEnabled['responseHeaders']['cache-control'][0]);
    }
    

    /**
     * @test
     *
     * @depends cssResponseSetupCacheEnabled
     */
    public function check_pretend_response_is_css_returns_correct_content_type_caching_enabled(array $cssResponseSetupCacheEnabled)
    {
        $this->assertSame('text/css; charset=utf-8', $cssResponseSetupCacheEnabled['responseHeaders']['content-type'][0]);
    }



    /**
     * @test
     *
     * @depends cssResponseSetupCacheDisabled
     */
    public function check_pretend_response_is_css_returns_correct_cache_control_caching_disabled(array $cssResponseSetupCacheDisabled)
    {
        $this->assertSame('max-age=1, public', $cssResponseSetupCacheDisabled['responseHeaders']['cache-control'][0]);
    }
    

    /**
     * @test
     *
     * @depends cssResponseSetupCacheDisabled
     */
    public function check_pretend_response_is_css_returns_correct_content_type_caching_disabled(array $cssResponseSetupCacheDisabled)
    {
        $this->assertSame('text/css; charset=utf-8', $cssResponseSetupCacheDisabled['responseHeaders']['content-type'][0]);
    }

}
