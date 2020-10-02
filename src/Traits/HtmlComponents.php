<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\HtmlString;

/**
 * Trait HtmlBuilder.
 */
trait HtmlComponents
{
    /**
     * Convert an HTML string to entities.
     *
     * @param string $value
     *
     * @return string
     */
    public function entities($value): string
    {
        return htmlentities($value, ENT_QUOTES, 'UTF-8', false);
    }

    /**
     * Generate an HTML image element.
     *
     * @param $url
     * @param  null  $alt
     * @param  array  $attributes
     * @param  null  $secure
     *
     * @return HtmlString
     */
    public function image($url, $alt = null, $attributes = [], $secure = null): HtmlString
    {
        $attributes['alt'] = $alt;

        return $this->html('<img src="'.resolve(UrlGenerator::class)->asset($url, $secure).'"'.$this->attributes($attributes).'>');
    }

    /**
     * Generate a HTML link.
     *
     * @param $url
     * @param  null  $title
     * @param  array  $attributes
     * @param  null  $secure
     * @param  bool  $escape
     *
     * @return HtmlString
     */
    public function link($url, $title = null, $attributes = [], $secure = null, $escape = true): HtmlString
    {
        $url = resolve(UrlGenerator::class)->to($url, [], $secure);

        if (is_null($title) || $title === false) {
            $title = $url;
        }

        if ($escape) {
            $title = $this->entities($title);
        }

        return $this->html('<a href="'.$this->entities($url).'"'.$this->attributes($attributes).'>'.$title.'</a>');
    }

    /**
     * Generate a HTTPS HTML link.
     *
     * @param $url
     * @param  null  $title
     * @param  array  $attributes
     * @param  bool  $escape
     *
     * @return HtmlString
     */
    public function secureLink($url, $title = null, $attributes = [], $escape = true): HtmlString
    {
        return $this->link($url, $title, $attributes, true, $escape);
    }

    /**
     * Generate a HTML link to an asset.
     *
     * @param string $url
     * @param string $title
     * @param array  $attributes
     * @param bool   $secure
     * @param bool   $escape
     *
     * @return HtmlString
     */
    public function linkAsset($url, $title = null, $attributes = [], $secure = null, $escape = true): HtmlString
    {
        $url = resolve(UrlGenerator::class)->asset($url, $secure);

        return $this->link($url, $title ?: $url, $attributes, $secure, $escape);
    }

    /**
     * Generate a HTTPS HTML link to an asset.
     *
     * @param string $url
     * @param string $title
     * @param array  $attributes
     * @param bool   $escape
     *
     * @return HtmlString
     */
    public function linkSecureAsset($url, $title = null, $attributes = [], $escape = true): HtmlString
    {
        return $this->linkAsset($url, $title, $attributes, true, $escape);
    }

    /**
     * Generate a HTML link to a named route.
     *
     * @param string $name
     * @param string $title
     * @param array  $parameters
     * @param array  $attributes
     * @param bool   $secure
     * @param bool   $escape
     *
     * @return HtmlString
     */
    public function linkRoute($name, $title = null, $parameters = [], $attributes = [], $secure = null, $escape = true): HtmlString
    {
        return $this->link(resolve(UrlGenerator::class)->route($name, $parameters), $title, $attributes, $secure, $escape);
    }

    /**
     * Generate a HTML link to a controller action.
     *
     * @param string $action
     * @param string $title
     * @param array  $parameters
     * @param array  $attributes
     * @param bool   $secure
     * @param bool   $escape
     *
     * @return HtmlString
     */
    public function linkAction($action, $title = null, $parameters = [], $attributes = [], $secure = null, $escape = true): HtmlString
    {
        return $this->link(resolve(UrlGenerator::class)->action($action, $parameters), $title, $attributes, $secure, $escape);
    }

    /**
     * Generate a HTML link to an email address.
     *
     * @param string $email
     * @param string $title
     * @param array  $attributes
     * @param bool   $escape
     *
     * @return HtmlString
     */
    public function mailto($email, $title = null, $attributes = [], $escape = true): HtmlString
    {
        $email = $this->email($email);

        $title = $title ?: $email;

        if ($escape) {
            $title = $this->entities($title);
        }

        $email = $this->obfuscate('mailto:').$email;

        return $this->html('<a href="'.$email.'"'.$this->attributes($attributes).'>'.$title.'</a>');
    }

    /**
     * Obfuscate an e-mail address to prevent spam-bots from sniffing it.
     *
     * @param string $email
     *
     * @return string
     */
    public function email($email): string
    {
        return str_replace('@', '&#64;', $this->obfuscate($email));
    }

    /**
     * Build an HTML attribute string from an array.
     *
     * @param array $attributes
     *
     * @return string
     */
    public function attributes($attributes): string
    {
        $html = [];

        foreach ((array) $attributes as $key => $value) {
            $element = $this->attributeElement($key, $value);

            if (! is_null($element)) {
                $html[] = $element;
            }
        }

        return count($html) > 0 ? ' '.implode(' ', $html) : '';
    }

    /**
     * Build a single attribute element.
     *
     * @param string $key
     * @param string $value
     *
     * @return string
     */
    protected function attributeElement($key, $value): string
    {
        // For numeric keys we will assume that the value is a boolean attribute
        // where the presence of the attribute represents a true value and the
        // absence represents a false value.
        // This will convert HTML attributes such as "required" to a correct
        // form instead of using incorrect numerics.
        if (is_numeric($key)) {
            return $value;
        }

        // Treat boolean attributes as HTML properties
        if (is_bool($value) && $key !== 'value') {
            return $value ? $key : '';
        }

        if (is_array($value) && $key === 'class') {
            return 'class="'.implode(' ', $value).'"';
        }

        if (! is_null($value)) {
            return $key.'="'.e($value, false).'"';
        }
    }

    /**
     * Obfuscate a string to prevent spam-bots from sniffing it.
     *
     * @param string $value
     *
     * @return string
     */
    public function obfuscate($value): string
    {
        $safe = '';

        foreach (str_split($value) as $letter) {
            if (ord($letter) > 128) {
                return $letter;
            }

            // To properly obfuscate the value, we will randomly convert each letter to
            // its entity or hexadecimal representation, keeping a bot from sniffing
            // the randomly obfuscated letters out of the string on the responses.
            switch (rand(1, 3)) {
                case 1:
                    $safe .= '&#'.ord($letter).';';
                    break;

                case 2:
                    $safe .= '&#x'.dechex(ord($letter)).';';
                    break;

                case 3:
                    $safe .= $letter;
            }
        }

        return $safe;
    }

    /**
     * Transform the string to an Html serializable object.
     *
     * @param $html
     *
     * @return HtmlString
     */
    public function html($html): HtmlString
    {
        return new HtmlString($html);
    }
}
