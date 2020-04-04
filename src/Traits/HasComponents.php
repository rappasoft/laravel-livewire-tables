<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

/**
 * Trait Components.
 */
trait HasComponents
{

    /**
     * @var array
     */
    protected $components = [];

    /**
     * @var bool
     */
    protected $hidden = false;

    /**
     * @var bool
     */
    protected $hiddenMessage = false;

    /**
     * @param  array  $components
     * @param  bool  $hidden
     * @param  bool  $hiddenMessage
     *
     * @return $this
     */
    public function components(array $components = [], $hidden = false, $hiddenMessage = false) : self {
        $this->components = $components;
        $this->hidden = $hidden;
        $this->hiddenMessage = $hiddenMessage;

        return $this;
    }

    /**
     * @param $component
     *
     * @return $this
     */
    public function addComponent($component) : self {
        $this->components[] = $component;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasComponents() : bool {
        return count($this->components) > 0;
    }

    /**
     * @return array
     */
    public function getComponents() : array {
        return $this->components;
    }

    /**
     * @param $model
     *
     * @return mixed
     */
    public function componentsAreHiddenForModel($model) {
        if (is_callable($this->hidden)) {
            return app()->call($this->hidden, ['model' => $model]);
        }

        return $this->hidden;
    }

    /**
     * @param $model
     *
     * @return bool|mixed
     */
    public function componentsHiddenMessageForModel($model) {
        if (is_callable($this->hiddenMessage)) {
            return app()->call($this->hiddenMessage, ['model' => $model]);
        }

        return $this->hiddenMessage;
    }
}
