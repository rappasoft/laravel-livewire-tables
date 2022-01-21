<?php

namespace Rappasoft\LaravelLivewireTables\Views;

/**
 * Class Filter.
 */
class Filter
{
    public const TYPE_DATE = 'date';

    public const TYPE_DATETIME_LOCAL = 'datetime-local';

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
     * @var array
     */
    public array $attributes = [];

    /**
     * @param  string  $name
     * @param  array|null  $attributes
     */
    public function __construct(string $name, ?array $attributes = [])
    {
        $this->name = $name;
        $this->attributes = $attributes;
    }

    /**
     * @param  string  $name
     * @param  array|null  $attributes
     *
     * @return Filter
     */
    public static function make(string $name, ?array $attributes = []): Filter
    {
        return new static($name, $attributes);
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
     * @param array $options
     *
     * @return $this
     */
    public function datetime(array $options = []): Filter
    {
        $this->type = self::TYPE_DATETIME_LOCAL;

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

    /**
     * @return bool
     */
    public function isDatetime(): bool
    {
        return $this->type === self::TYPE_DATETIME_LOCAL;
    }
}
