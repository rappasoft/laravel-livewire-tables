<?php

namespace Rappasoft\LaravelLivewireTables\Features;

use Illuminate\Foundation\Http\Events\RequestHandled;
use Livewire\ComponentHook;
use Rappasoft\LaravelLivewireTables\Mechanisms\RappasoftFrontendAssets;

use function Livewire\on;

class AutoInjectRappasoftAssets extends ComponentHook
{
    public static bool $hasRenderedAComponentThisRequest = false;

    public static bool $forceAssetInjection = false;

    public ?bool $shouldInjectRappasoftThirdPartyAssets = null;

    public ?bool $shouldInjectRappasoftAssets = null;

    public static function provide(): void
    {
        on('flush-state', function () {
            static::$hasRenderedAComponentThisRequest = false;
            static::$forceAssetInjection = false;
        });

        // If config use_bundler is true - abort injection of assets
        if (config('livewire-tables.inject_core_assets_enabled', true) === false 
            && config('livewire-tables.inject_third_party_assets_enabled', true) === false 
            && config('livewire-tables.enable_blade_directives', false) === false
        ) {
            return;
        }

        app('events')->listen(RequestHandled::class, function (RequestHandled $handled) {

            if (! static::$forceAssetInjection && (config('livewire-tables.inject_core_assets_enabled', false) === false || ! static::$hasRenderedAComponentThisRequest)) {
                return;
            }

            if (! str($handled->response->headers->get('content-type'))->contains('text/html')) {
                return;
            }

            if (! method_exists($handled->response, 'status') || ! method_exists($handled->response, 'getContent') || ! method_exists($handled->response, 'setContent') || ! method_exists($handled->response, 'getOriginalContent') || ! property_exists($handled->response, 'original')) {
                return;
            }

            if ($handled->response->status() !== 200) {
                return;
            }

            if (! static::shouldInjectAssets()) {
                return;
            }

            $html = $handled->response->getContent();

            if (str($html)->contains('</html>')) {
                $original = $handled->response->getOriginalContent();
                $handled->response->setContent(static::injectAssets($html));
                $handled->response->original = $original;
            }
        });
    }

    public static function setShouldInjectRappasoftAssets(bool $shouldInject = false): void
    {
        static::$shouldInjectRappasoftAssets = $shouldInject;
    }

    public static function setShouldInjectRappsoftTableThirdPartyAssets(bool $shouldInject = false): void
    {
        static::$shouldInjectRappasoftThirdPartyAssets = $shouldInject;
    }


    public static function shouldInjectAssets(): bool
    {
        if (!isset(static::$shouldInjectRappasoftAssets))
        {
            static::setShouldInjectRappasoftAssets(config('livewire-tables.inject_core_assets_enabled', true));
        }
        if (!isset(static::$shouldInjectRappasoftThirdPartyAssets))
        {
            static::setShouldInjectRappsoftTableThirdPartyAssets(config('livewire-tables.inject_third_party_assets_enabled', true));
        }

        
        // If Neither Core nor Third Party Assets are injectable
        if (!static::$shouldInjectRappasoftAssets && !static::$shouldInjectRappasoftThirdPartyAssets)
        {
            return false;
        }

        if (static::$shouldInjectRappasoftAssets && !app(RappasoftFrontendAssets::class)->hasRenderedRappsoftTableScripts)
        {
            return true;
        }


        if (static::$shouldInjectRappasoftThirdPartyAssets && !app(RappasoftFrontendAssets::class)->hasRenderedRappsoftTableThirdPartyScripts)
        {
            return true;
        }

        

        // Fall Back to Not Injecting
        return false;
    }

    public function dehydrate(): void
    {
        static::$hasRenderedAComponentThisRequest = true;
    }

    public static function injectAssets(mixed $html): string
    {

        $html = str($html);

        if ($html->test('/<\s*head(?:\s|\s[^>])*>/i') && $html->test('/<\s*\/\s*body\s*>/i')) {
            return $html
                ->replaceMatches('/(<\s*head(?:\s|\s[^>])*>)/i', '$1'.((static::$shouldInjectRappasoftAssets ? app(RappasoftFrontendAssets::class)->tableStyles() : '').' '.(static::$shouldInjectRappasoftThirdPartyAssets ? app(RappasoftFrontendAssets::class)->tableThirdPartyStyles() : '')))
                ->replaceMatches('/(<\s*\/\s*head\s*>)/i', ((static::$shouldInjectRappasoftAssets ? app(RappasoftFrontendAssets::class)->tableScripts() : '').' '.(static::$shouldInjectRappasoftThirdPartyAssets ? app(RappasoftFrontendAssets::class)->tableThirdPartyScripts() : '')).'$1')
                ->toString();
        }

        return $html
            ->replaceMatches('/(<\s*html(?:\s[^>])*>)/i', '$1'.((static::$shouldInjectRappasoftAssets ? app(RappasoftFrontendAssets::class)->tableStyles() : '').' '.(static::$shouldInjectRappasoftThirdPartyAssets? app(RappasoftFrontendAssets::class)->tableThirdPartyStyles() : '')))
            ->replaceMatches('/(<\s*\/\s*head\s*>)/i', ((static::$shouldInjectRappasoftAssets ? app(RappasoftFrontendAssets::class)->tableScripts() : '') . ' '. (static::$shouldInjectRappasoftThirdPartyAssets ? app(RappasoftFrontendAssets::class)->tableThirdPartyScripts() : '')).'$1')
            ->toString();
    }
}
