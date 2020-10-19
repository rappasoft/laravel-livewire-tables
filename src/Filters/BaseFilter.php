<?php

namespace Rappasoft\LaravelLivewireTables\Filters;

class BaseFilter
{
    public $title;

    public $id;

    public function __construct(?string $id = null, ?string $title = null)
    {
        $this->id = $id ?: $this->getId();
        $this->title = $title ?: $this->getTitle();
    }

    public function selected()
    {
        $request = request();
        $selected = '';

        if (! empty(request()->has('filters'))) {
            $filters = $request->get('filters');

            if (isset($filters[$this->id])) {
                $value = $filters[$this->id];
                if ($value !== "" && $value !== null) {
                    $selected = $value;
                    if (is_array($selected)) {
                        foreach ($selected as $key => $value) {
                            $selected[$key] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                        }
                    }
                }
            }
        }

        return $selected;
    }

    public function passValuesFromRequestToFilter($values)
    {
        return $values;
    }

    /**
     * Get filter title
     */
    public function getTitle(): string
    {
        if (! $this->title) {
            return $this->camelToTitle((new \ReflectionClass($this))->getShortName());
        }

        return $this->title;
    }

    /**
     * Get filter id
     */
    public function getId(): string
    {
        if (! $this->id) {
            return $this->camelToDashCase((new \ReflectionClass($this))->getShortName());
        }

        return $this->id;
    }

    private function camelToTitle($str): string
    {
        $intermediate = preg_replace('/(?!^)([[:upper:]][[:lower:]]+)/', ' $0', $str);
        $titleStr = preg_replace('/(?!^)([[:lower:]])([[:upper:]])/', '$1 $2', $intermediate);

        return strpos($titleStr, 'Filter', -6) ? trim(substr_replace($titleStr, '', -6)) : $titleStr;
    }

    private function camelToDashCase($str): string
    {
        $id = strtolower(preg_replace('%([a-z])([A-Z])%', '\1-\2', $str));

        return strpos($id, '_filter', -7) ? trim(substr_replace($id, '', -7)) : $id;
    }
}
