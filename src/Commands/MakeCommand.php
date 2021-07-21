<?php

namespace Rappasoft\LaravelLivewireTables\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Commands\ComponentParser;
use Livewire\Commands\MakeCommand as LivewireMakeCommand;

class MakeCommand extends Command
{
    protected $parser;
    protected $model = null;
    protected $viewPath = null;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:table
        {name : The name of your Livewire class}
        {model? : The name of the model you want to use in this table }
        {--view : We will generate a row view for you}
        {--force }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a Laravel Livewire table class and view';

    public function handle()
    {
        $this->parser = new ComponentParser(
            config('livewire.class_namespace'),
            config('livewire.view_path'),
            $this->argument('name')
        );

        $livewireMakeCommand = new LivewireMakeCommand();

        if($livewireMakeCommand->isReservedClassName($name = $this->parser->className())) {
            $this->line("<options=bold,reverse;fg=red> WHOOPS! </> 😳 \n");
            $this->line("<fg=red;options=bold>Class is reserved:</> {$name}");
            return;
        }

        $this->model = Str::studly($this->argument('model'));
        $force = $this->option('force');

        $this->viewPath = $this->createView($force);
        $this->createClass($force);

        $this->info('Livewire Datatable Created: ' . $this->parser->className());
    }

    protected function createClass($force = false)
    {
        $classPath = $this->parser->classPath();

        if (File::exists($classPath) && ! $force) {
            $this->line("<options=bold,reverse;fg=red> WHOOPS-IE-TOOTLES </> 😳 \n");
            $this->line("<fg=red;options=bold>Class already exists:</> {$this->parser->relativeClassPath()}");

            return false;
        }

        $this->ensureDirectoryExists($classPath);

        File::put($classPath, $this->classContents());

        return $classPath;
    }

    protected function createView($force = false)
    {
        if(! $this->option('view')) {
            return null;
        }
        $viewPath = base_path('resources/views/livewire-tables/rows/' . Str::snake($this->parser->className()->__toString()) . '.blade.php');
        if (File::exists($viewPath) && ! $force) {
            $this->line("<options=bold,reverse;fg=red> WHOOPS-IE-TOOTLES </> 😳 \n");
            $this->line("<fg=red;options=bold>View already exists:</> {$viewPath}");

            return false;
        }

        $this->ensureDirectoryExists($viewPath);

        File::put($viewPath, $this->viewContents());

        return $viewPath;
    }

    protected function ensureDirectoryExists($path)
    {
        if (! File::isDirectory(dirname($path))) {
            File::makeDirectory(dirname($path), 0777, $recursive = true, $force = true);
        }
    }

    public function classContents()
    {
        if($this->model) {
            $template = file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'table-with-model.stub');

            $contents = preg_replace_array(
                ['/\[namespace\]/', '/\[class\]/', '/\[model\]/', '/\[model_import\]/'],
                [$this->parser->classNamespace(), $this->parser->className(), $this->model, $this->getModelImport()],
                $template
            );
        } else {
            $template = file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'table.stub');

            $contents =  preg_replace_array(
                ['/\[namespace\]/', '/\[class\]/'],
                [$this->parser->classNamespace(), $this->parser->className()],
                $template
            );
        }

        if($this->viewPath) {
            $viewPath = Str::after($this->viewPath, 'resources/views/');
            $contents = Str::replaceLast("}\n", "
    public function rowView(): string
    {
        return '" . $viewPath . "';
    }
}\n",
                $contents);
        }

        return $contents;
    }

    public function viewContents()
    {
        return file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'view.stub');
    }

    public function getModelImport()
    {
        if(File::exists(app_path('Models/' . $this->model . '.php'))) {
            return 'App\Models\\' . $this->model;
        }
        if(File::exists(app_path($this->model . '.php'))) {
            return 'App\\' . $this->model;
        }
        $this->error('Could not find path to model');
        return 'App\Models\\' . $this->model;
    }
}
