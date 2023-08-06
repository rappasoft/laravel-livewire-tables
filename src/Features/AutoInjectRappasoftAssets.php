<?php

namespace Rappasoft\LaravelLivewireTables\Features;

use Illuminate\Foundation\Http\Events\RequestHandled;
use Livewire\ComponentHook;
use function Livewire\on;
use Rappasoft\LaravelLivewireTables\Mechanisms\RappasoftFrontendAssets;

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

            if (app(RappasoftFrontendAssets::class)->hasRenderedRappsoftScripts) {
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
        $rappasoftStyles = RappasoftFrontendAssets::styles();
        $rappasoftScripts = RappasoftFrontendAssets::scripts();

        $html = str($html);

        if ($html->test('/<\s*head(?:\s|\s[^>])*>/i') && $html->test('/<\s*\/\s*body\s*>/i')) {
            return $html
                ->replaceMatches('/(<\s*head(?:\s|\s[^>])*>)/i', '$1'.$rappasoftStyles)
                ->replaceMatches('/(<\s*\/\s*head\s*>)/i', $rappasoftScripts.'$1')
                ->toString();
        }

        return $html
            ->replaceMatches('/(<\s*html(?:\s[^>])*>)/i', '$1'.$rappasoftStyles)
            ->replaceMatches('/(<\s*\/\s*head\s*>)/i', $rappasoftScripts.'$1')
            ->toString();
    }
}
