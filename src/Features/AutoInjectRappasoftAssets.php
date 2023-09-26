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

    public static bool $shouldInjectRappasoftThirdPartyAssets = false;

    public static bool $shouldInjectRappasoftAssets = false;

    public static function provide(): void
    {
        static::$shouldInjectRappasoftAssets = config('livewire-tables.inject_core_assets_enabled', true);
        static::$shouldInjectRappasoftThirdPartyAssets = config('livewire-tables.inject_third_party_assets_enabled', true);

        on('flush-state', function () {
            static::$hasRenderedAComponentThisRequest = false;
            static::$forceAssetInjection = false;
        });

        if (static::$shouldInjectRappasoftAssets || static::$shouldInjectRappasoftThirdPartyAssets) {

            app('events')->listen(RequestHandled::class, function (RequestHandled $handled) {

                if (! static::$shouldInjectRappasoftAssets && ! static::$shouldInjectRappasoftThirdPartyAssets) {
                    return;
                }

                // If All Scripts Have Been Rendered - Return
                if (
                    (
                        ! static::$shouldInjectRappasoftAssets || app(RappasoftFrontendAssets::class)->hasRenderedRappsoftTableScripts
                    ) &&
                    (
                        ! static::$shouldInjectRappasoftThirdPartyAssets || app(RappasoftFrontendAssets::class)->hasRenderedRappsoftTableThirdPartyScripts
                    )
                ) {
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

                $html = $handled->response->getContent();

                if (str($html)->contains('</html>')) {
                    $original = $handled->response->getOriginalContent();
                    $handled->response->setContent(static::injectAssets($html));
                    $handled->response->original = $original;
                }
            });
        }
    }

    public function dehydrate(): void
    {
        static::$hasRenderedAComponentThisRequest = true;
    }

    public static function injectAssets(mixed $html): string
    {

        $html = str($html);
        $rappaStyles = ((static::$shouldInjectRappasoftAssets === true) ? RappasoftFrontendAssets::tableStyles() : '').' '.((static::$shouldInjectRappasoftThirdPartyAssets === true) ? RappasoftFrontendAssets::tableThirdPartyStyles() : '');
        $rappaScripts = ((static::$shouldInjectRappasoftAssets === true) ? RappasoftFrontendAssets::tableScripts() : '').' '.((static::$shouldInjectRappasoftThirdPartyAssets === true) ? RappasoftFrontendAssets::tableThirdPartyScripts() : '');

        if ($html->test('/<\s*head(?:\s|\s[^>])*>/i') && $html->test('/<\s*\/\s*body\s*>/i')) {
            static::$shouldInjectRappasoftAssets = static::$shouldInjectRappasoftThirdPartyAssets = false;

            return $html
                ->replaceMatches('/(<\s*head(?:\s|\s[^>])*>)/i', '$1'.$rappaStyles)
                ->replaceMatches('/(<\s*\/\s*head\s*>)/i', $rappaScripts.'$1')
                ->toString();
        }
        static::$shouldInjectRappasoftAssets = static::$shouldInjectRappasoftThirdPartyAssets = false;

        return $html
            ->replaceMatches('/(<\s*html(?:\s[^>])*>)/i', '$1'.$rappaStyles)
            ->replaceMatches('/(<\s*\/\s*head\s*>)/i', $rappaScripts.'$1')
            ->toString();
    }
}
