<?php

namespace Rappasoft\LaravelLivewireTables\Features;

use Livewire\ComponentHook;
use Livewire\Exceptions\MethodNotFoundException;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use ReflectionMethod;

/**
 * Livewire lets the browser call every public method of a component, and this package's
 * configuration methods (setPrimaryKey(), setConfigurableArea(), ...) have to be public.
 * Only the methods a table lists in browserCallableMethods() stay reachable.
 */
class GuardBrowserCalls extends ComponentHook
{
    public function call(string $method, mixed $params, mixed $returnEarly): void
    {
        if (! $this->component instanceof DataTableComponent || ! method_exists($this->component, $method)) {
            return;
        }

        // Only this package's own methods are policed: anything the application wrote
        // (bulk actions, overrides) or Livewire provides (pagination) is left alone
        $packageSource = dirname(__DIR__).DIRECTORY_SEPARATOR;

        if (! str_starts_with((string) (new ReflectionMethod($this->component, $method))->getFileName(), $packageSource)) {
            return;
        }

        if (! in_array($method, $this->component->browserCallableMethods(), true)) {
            throw new MethodNotFoundException($method);
        }
    }
}
