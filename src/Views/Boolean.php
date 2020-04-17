<?php

namespace Rappasoft\LaravelLivewireTables\Views;

use Illuminate\Support\Str;

/**
 * Class Boolean.
 */
class Boolean extends Component
{
    /**
     * Component constructor.
     *
     * @param $text
     */
    public function __construct($text, $column = false, $key = false)
    {
        $this->options['text'] = $text;
        $this->options['column'] = $column ?? Str::snake(Str::lower($text));
        $this->options['key'] = $key ?? null;
        $this->options['jsonKeyVal'] = false;
        $this->options['icon'] = [
            'true' => false,
            'false' => false,
            'true-class' => false,
            'false-class' => false,
        ];
    }

    /**
     * @param  string  $text
     * @param  string  $attribute
     * @param  string  $key
     * @return self
     */
    public static function make($text = null, $attribute = null, $key = null): self
    {
        return new static($text, $attribute, $key);
    }

    /**
     * @param $text
     *
     * @return self
     */
    public function text($text): self
    {
        return $this->setAttribute('text', $text);
    }

    /**
     * @param $class
     *
     * @return $this
     */
    public function class($class): self
    {
        return $this->setAttribute('class', $class);
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function id($id): self
    {
        return $this->setAttribute('id', $id);
    }

    /**
     * @param array $icon
     *
     * @return $this
     */
    public function icon(array $icon): self
    {
        return $this->setOption('icon', [
            'true' => $icon['true'] ?? null,
            'false' => $icon['false'] ?? null,
            'true-class' => $icon['true-class'] ?? null,
            'false-class' => $icon['false-class'] ?? null,
        ]);
    }

    /**
     * @param void
     *
     * @return $this
     */
    public function jsonKeyVal(): self
    {
        return $this->setOption('jsonKeyVal', true);
    }


    /**
     * @return string
     */
    public function view(): string
    {
        return 'laravel-livewire-tables::components.boolean';
    }
}
