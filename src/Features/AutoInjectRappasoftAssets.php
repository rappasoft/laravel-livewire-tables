<?php

namespace Rappasoft\LaravelLivewireTables\Features;

use Illuminate\Foundation\Http\Events\RequestHandled;
use Livewire\ComponentHook;
use Rappasoft\LaravelLivewireTables\Mechanisms\RappasoftFrontendAssets;
use Illuminate\Support\Facades\Log;

use function Livewire\on;

class AutoInjectRappasoftAssets extends ComponentHook
{
    public static bool $hasRenderedAComponentThisRequest = false;

    public static bool $forceAssetInjection = false;

    public static function provide(): void
    {
        on('flush-state', function () {
            static::$hasRenderedAComponentThisRequest = false;
            static::$forceAssetInjection = false;
        });

        if (config('livewire-tables.inject_assets', true) === false) {
            return;
        }

        app('events')->listen(RequestHandled::class, function (RequestHandled $handled) {
            
            if (! static::$forceAssetInjection && config('livewire-tables.inject_assets', true) === false) {
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


            if ((! static::$hasRenderedAComponentThisRequest) && (! static::$forceAssetInjection)) {
                return;
            }
            if (config('livewire-tables.inject_assets', true) === false && config('livewire-tables.inject_third_party_assets', true) === false) {
                return;
            }
            if (config('livewire-tables.inject_assets', true) === true && app(RappasoftFrontendAssets::class)->hasRenderedRappsoftTableScripts && config('livewire-tables.inject_third_party_assets', true) === true && app(RappasoftFrontendAssets::class)->hasRenderedRappsoftTableThirdPartyScripts) {
                return;
            } elseif (config('livewire-tables.inject_assets', true) === true && app(RappasoftFrontendAssets::class)->hasRenderedRappsoftTableScripts) {
                return;
            } elseif (config('livewire-tables.inject_third_party_assets', true) === true && app(RappasoftFrontendAssets::class)->hasRenderedRappsoftTableThirdPartyScripts) {
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

    public function dehydrate(): void
    {
        static::$hasRenderedAComponentThisRequest = true;
    }

    public static function injectAssets(mixed $html): string
    {

        $html = str($html);

        if ($html->test('/<\s*head(?:\s|\s[^>])*>/i') && $html->test('/<\s*\/\s*body\s*>/i')) {
            return $html
                ->replaceMatches('/(<\s*head(?:\s|\s[^>])*>)/i', '$1'.((config('livewire-tables.inject_assets', true) ? RappasoftFrontendAssets::tableStyles() : '').' '.(config('livewire-tables.inject_third_party_assets', true) ? RappasoftFrontendAssets::tableThirdPartyStyles() : '')))
                ->replaceMatches('/(<\s*\/\s*head\s*>)/i', ((config('livewire-tables.inject_assets', true) ? RappasoftFrontendAssets::tableScripts() : '').' '.(config('livewire-tables.inject_third_party_assets', true) ? RappasoftFrontendAssets::tableThirdPartyScripts() : '')).'$1')
                ->toString();
        }

        return $html
            ->replaceMatches('/(<\s*html(?:\s[^>])*>)/i', '$1'.((config('livewire-tables.inject_assets', true) ? RappasoftFrontendAssets::tableStyles() : '').' '.(config('livewire-tables.inject_third_party_assets', true) ? RappasoftFrontendAssets::tableThirdPartyStyles() : '')))
            ->replaceMatches('/(<\s*\/\s*head\s*>)/i', ((config('livewire-tables.inject_assets', true) ? RappasoftFrontendAssets::tableScripts() : '').' '.(config('livewire-tables.inject_third_party_assets', true) ? RappasoftFrontendAssets::tableThirdPartyScripts() : '')).'$1')
            ->toString();
    }
}
