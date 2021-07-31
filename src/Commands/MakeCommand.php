<?php

namespace Rappasoft\LaravelLivewireTables\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Commands\ComponentParser;
use Livewire\Commands\MakeCommand as LivewireMakeCommand;

/**
 * Class MakeCommand
 *
 * @package Rappasoft\LaravelLivewireTables\Commands
 */
class MakeCommand extends Command
{

    /**
     * @var
     */
    protected $parser;

    /**
     * @var
     */
    protected $model;

    /**
     * @var
     */
    protected $viewPath;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:datatable
        {name : The name of your Livewire class}
        {model? : The name of the model you want to use in this table}
        {--view : We will generate a row view for you}
        {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a Laravel Livewire datatable class and view.';
    
    public function handle(): void
    {
        $this->parser = new ComponentParser(
            config('livewire.class_namespace'),
            config('livewire.view_path'),
            $this->argument('name')
        );

        $livewireMakeCommand = new LivewireMakeCommand();

        if ($livewireMakeCommand->isReservedClassName($name = $this->parser->className())) {
            $this->line("<fg=red;options=bold>Class is reserved:</> {$name}");

            return;
        }

        $this->model = Str::studly($this->argument('model'));
        $force = $this->option('force');

        $this->viewPath = $this->createView($force);
        $this->createClass($force);

        $this->info('Livewire Datatable Created: ' . $this->parser->className());
    }

    /**
     * @param  bool  $force
     *
     * @return false
     */
    protected function createClass(bool $force = false)
    {
        $classPath = $this->parser->classPath();

        if (! $force && File::exists($classPath)) {
            $this->line("<fg=red;options=bold>Class already exists:</> {$this->parser->relativeClassPath()}");

            return false;
        }

        $this->ensureDirectoryExists($classPath);

        File::put($classPath, $this->classContents());

        return $classPath;
    }

    /**
     * @param  bool  $force
     *
     * @return false|string|null
     */
    protected function createView(bool $force = false)
    {
        if (! $this->option('view')) {
            return null;
        }

        $viewPath = base_path('resources/views/livewire-tables/rows/' . Str::snake($this->parser->className()->__toString()) . '.blade.php');

        if (! $force && File::exists($viewPath)) {
            $this->line("<fg=red;options=bold>View already exists:</> {$viewPath}");

            return false;
        }

        $this->ensureDirectoryExists($viewPath);

        File::put($viewPath, $this->viewContents());

        return $viewPath;
    }

    /**
     * @param $path
     */
    protected function ensureDirectoryExists($path): void
    {
        if (! File::isDirectory(dirname($path))) {
            File::makeDirectory(dirname($path), 0777, true, true);
        }
    }

    /**
     * @return string
     */
    public function classContents(): string
    {
        if ($this->model) {
            $template = file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'table-with-model.stub');

            $contents = str_replace(
                ['[namespace]', '[class]', '[model]', '[model_import]'],
                [$this->parser->classNamespace(), $this->parser->className(), $this->model, $this->getModelImport()],
                $template
            );
        } else {
            $template = file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'table.stub');

            $contents = str_replace(
                ['[namespace]', '[class]'],
                [$this->parser->classNamespace(), $this->parser->className()],
                $template
            );
        }

        if ($this->viewPath) {
            $contents = Str::replaceLast(
                "}\n",
                "
    public function rowView(): string
    {
        return '" . $this->getViewPathForRowView() . "';
    }
}\n",
                $contents
            );
        }

        return $contents;
    }

    /**
     * @return string
     */
    private function getViewPathForRowView(): string
    {
        return Str::replace('/', '.', Str::before(Str::after($this->viewPath, 'resources/views/'), '.blade.php'));
    }

    /**
     * @return false|string
     */
    public function viewContents()
    {
        return file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'view.stub');
    }

    /**
     * @return string
     */
    public function getModelImport(): string
    {
        if (File::exists(app_path('Models/' . $this->model . '.php'))) {
            return 'App\Models\\' . $this->model;
        }

        if (File::exists(app_path($this->model . '.php'))) {
            return 'App\\' . $this->model;
        }

        $this->error('Could not find path to model.');

        return 'App\Models\\' . $this->model;
    }
}
