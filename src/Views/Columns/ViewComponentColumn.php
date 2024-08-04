<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Illuminate\View\ComponentAttributeBag;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\ViewComponentColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\ViewComponentColumnHelpers;
use ReflectionClass;

class ViewComponentColumn extends Column
{
    use ViewComponentColumnConfiguration,
        ViewComponentColumnHelpers;

    protected ?string $componentView;

    protected ?string $customComponentView;

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        $this->html();

    }

    public function getContents(Model $row): null|string|HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        if ($this->isLabel()) {
            throw new DataTableConfigurationException('You can not use a label column with a component column');
        }

        if ($this->hasComponentView() === false && $this->hasCustomComponent() === false) {
            throw new DataTableConfigurationException('You must specify a component view for a component column');
        }

        $value = $this->getValue($row);
        $attributes = ['value' => $value];

        if ($this->hasAttributesCallback()) {
            $attributes = call_user_func($this->getAttributesCallback(), $value, $row, $this);

            if (! is_array($attributes)) {
                throw new DataTableConfigurationException('The return type of callback must be an array');
            }
        }

        if ($this->hasCustomComponent()) {
            $reflectionClass = new ReflectionClass($this->getCustomComponent());

            $reflectionInstance = $reflectionClass->newInstanceArgs($attributes);

            return $reflectionInstance->render();
        } else {
            return view($this->getComponentView())->with($attributes);
        }

    }
}
