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

    public static function provide(): void
    {
        on('flush-state', function () {
            static::$hasRenderedAComponentThisRequest = false;
            static::$forceAssetInjection = false;
        });

        if (config('livewire-tables.inject_assets', true) === false) {
            return;
        }

        app('events')->listen(RequestHandled::class, function ($handled) {

            if (app(RappasoftFrontendAssets::class)->hasRenderedRappsoftTableScripts && app(RappasoftFrontendAssets::class)->hasRenderedRappsoftTableThirdPartyScripts) {
                return;
            }

            $html = $handled->response->getContent();

            if (str($html)->contains('</html>')) {
                $handled->response->setContent(static::injectAssets($html));
            }
        });
    }

    public function dehydrate(): void
    {
        static::$hasRenderedAComponentThisRequest = true;
    }

    public static function injectAssets(mixed $html): string
    {
        $rappasoftTableStyles = RappasoftFrontendAssets::tableStyles();
        $rappasoftTableScripts = RappasoftFrontendAssets::tableScripts();
        $rappasoftTableThirdPartyStyles = (config('livewire-tables.inject_third_party_assets', true) === false) ? RappasoftFrontendAssets::tableThirdPartyStyles() : '';
        //$rappasoftTableThirdPartyStyles = '';
        $rappasoftTableThirdPartyScripts = (config('livewire-tables.inject_third_party_assets', true) !== false) ? RappasoftFrontendAssets::tableThirdPartyScripts() : '';
        //$rappasoftTableThirdPartyScripts = '';

        $html = str($html);

        if ($html->test('/<\s*head(?:\s|\s[^>])*>/i') && $html->test('/<\s*\/\s*body\s*>/i')) {
            return $html
                ->replaceMatches('/(<\s*head(?:\s|\s[^>])*>)/i', '$1'.($rappasoftTableStyles.' '.$rappasoftTableThirdPartyStyles))
                ->replaceMatches('/(<\s*\/\s*head\s*>)/i', ($rappasoftTableScripts.' '.$rappasoftTableThirdPartyScripts).'$1')
                ->toString();
        }

        return $html
            ->replaceMatches('/(<\s*html(?:\s[^>])*>)/i', '$1'.($rappasoftTableStyles.' '.$rappasoftTableThirdPartyStyles))
            ->replaceMatches('/(<\s*\/\s*head\s*>)/i', ($rappasoftTableScripts.' '.$rappasoftTableThirdPartyScripts).'$1')
            ->toString();
    }
}
