<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

trait HasSlot
{
    protected ?Closure $slotCallback = null;

    public function getSlotContent(Model $row, mixed $value): string|HtmlString
    {
        $slotContent = call_user_func($this->getSlotCallback(), $value, $row, $this);
        if (is_string($slotContent)) {
            $slotContent = new HtmlString($slotContent);
        }

        return $slotContent;
    }

    public function getSlotCallback(): ?callable
    {
        return $this->slotCallback;
    }

    public function hasSlotCallback(): bool
    {
        return isset($this->slotCallback) && $this->slotCallback !== null;
    }

    public function slot(callable $callback): self
    {
        $this->slotCallback = $callback;

        return $this;
    }
}
