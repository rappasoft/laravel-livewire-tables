<?php

namespace Rappasoft\LaravelLivewireTables\Views;

/**
 * Class Filter.
 */
class Filter
{
    public const TYPE_DATE = 'date';

    public const TYPE_SELECT = 'select';

    public const TYPE_MULTISELECT = 'multiselect';

    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $type;

    /**
     * @var array
     */
    public array $options = [];

    /**
     * Filter constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $name
     *
     * @return Filter
     */
    public static function make(string $name): Filter
    {
        return new static($name);
    }

    /**
     * @param array $options
     *
     * @return $this
     */
    public function select(array $options = []): Filter
    {
        $this->type = self::TYPE_SELECT;

        $this->options = $options;

        return $this;
    }

    /**
     * @param array $options
     *
     * @return $this
     */
    public function multiSelect(array $options = []): Filter
    {
        $this->type = self::TYPE_MULTISELECT;

        $this->options = $options;

        return $this;
    }

    /**
     * @param array $options
     *
     * @return $this
     */
    public function date(array $options = []): Filter
    {
        $this->type = self::TYPE_DATE;

        $this->options = $options;

        return $this;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function options(): array
    {
        return $this->options;
    }

    /**
     * @return bool
     */
    public function isSelect(): bool
    {
        return $this->type === self::TYPE_SELECT;
    }

    /**
     * @return bool
     */
    public function isMultiSelect(): bool
    {
        return $this->type === self::TYPE_MULTISELECT;
    }

    /**
     * @return bool
     */
    public function isDate(): bool
    {
        return $this->type === self::TYPE_DATE;
    }
}
