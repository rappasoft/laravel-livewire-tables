<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Mechanisms;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Livewire\Drawer\Utils;

trait WithRappasoftTableThirdPartyStyles
{
    /** Rappasoft Third Party Styles */
    public bool $hasRenderedRappsoftTableThirdPartyStyles = false;

    public mixed $rappasoftTableThirdPartyStyleRoute;

    public array $rappasoftTableThirdPartyStyleTagAttributes = [];

    public function bootWithRappasoftTableThirdPartyStyles(): void
    {
        // Set the CSS route for the third party CSS
        app($this::class)->setRappasoftTableThirdPartyStyleRoute(function ($handle) {
            $stylesPath = '/rappasoft/laravel-livewire-tables/thirdparty.css';

            return Route::get($stylesPath, $handle);
        });

        Blade::directive('rappasoftTableThirdPartyStyles', [static::class, 'rappasoftTableThirdPartyStyles']);

    }

    /**
     *  Used If Injection is Enabled
     */
    public function setRappasoftTableThirdPartyStylesRoute(callable $callback): void
    {
        $route = $callback([self::class, 'returnRappasoftTableThirdPartyStylesAsFile']);

        $this->rappasoftTableThirdPartyStyleRoute = $route;
    }

    public function returnRappasoftTableThirdPartyStylesAsFile(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->pretendResponseIsCSS(__DIR__.'/../../../resources/css/laravel-livewire-tables-thirdparty.css');
    }

    /**
     *  Used If Injection is Disabled
     */
    public static function rappasoftTableThirdPartyStyles(mixed $expression): string
    {
        return '{!! \Rappasoft\LaravelLivewireTables\Mechanisms\RappasoftFrontendAssets::tableThirdPartyStyles('.$expression.') !!}';
    }

    public static function tableThirdPartyStyles(array $options = []): array|string|null
    {
        app(static::class)->hasRenderedRappsoftTableThirdPartyStyles = true;

        $debug = config('app.debug');

        $styles = static::tableThirdPartyCss($options);

        // HTML Label.
        $html = $debug ? ['<!-- Rappasoft Table Third Party Styles -->'] : [];

        $html[] = $styles;

        return implode("\n", $html);

    }

    public static function tableThirdPartyCss(array $options = []): ?string
    {
        $styleUrl = app(static::class)->rappasoftTableThirdPartyStyleRoute->uri;
        $styleUrl = rtrim($styleUrl, '/');

        $styleUrl = (string) str($styleUrl)->start('/');

        return <<<HTML
            <link href="{$styleUrl}" rel="stylesheet" />
        HTML;
    }
}
