<?php

namespace Rappasoft\LaravelLivewireTables\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Commands\ComponentParser;
use Livewire\Commands\MakeCommand as LivewireMakeCommand;

/**
 * Class MakeCommand
 */
class MakeCommand extends Command
{
    protected ComponentParser $parser;

    /**
     * @var string
     */
    protected $model;

    /**
     * @var string|null
     */
    protected $modelPath;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:datatable
        {name : The name of your Livewire class}
        {model : The name of the model you want to use in this table}
        {modelpath? : The name of the model you want to use in this table}
        {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a Laravel Livewire Datatable class.';

    /**
     * Generate the Datatable component
     */
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
        $this->modelPath = $this->argument('modelpath') ?? null;

        $force = $this->option('force');

        $this->createClass($force);

        $this->info('Livewire Datatable Created: '.$this->parser->className());
    }

    protected function createClass(bool $force = false): bool
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
     * @param  mixed  $path
     */
    protected function ensureDirectoryExists($path): void
    {
        if (! File::isDirectory(dirname($path))) {
            File::makeDirectory(dirname($path), 0777, true, true);
        }
    }

    public function classContents(): string
    {
        return str_replace(
            ['[namespace]', '[class]', '[model]', '[model_import]', '[columns]'],
            [$this->parser->classNamespace(), $this->parser->className(), $this->model, $this->getModelImport(), $this->generateColumns($this->getModelImport())],
            file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'table.stub')
        );
    }

    public function getModelImport(): string
    {
        if (File::exists(app_path('Models/'.$this->model.'.php'))) {
            return 'App\Models\\'.$this->model;
        }

        if (File::exists(app_path($this->model.'.php'))) {
            return 'App\\'.$this->model;
        }

        if (isset($this->modelPath)) {
            if (File::exists(rtrim($this->modelPath, '/').'/'.$this->model.'.php')) {

                return Str::studly(str_replace('/', '\\', $this->modelPath)).$this->model;
            }
        }

        $this->error('Could not find path to model.');

        return 'App\Models\\'.$this->model;
    }

    /**
     * @throws \Exception
     */
    private function generateColumns(string $modelName): string
    {
        $model = new $modelName();

        if ($model instanceof Model === false) {
            throw new \Exception('Invalid model given.');
        }

        $getFillable = array_merge(
            [$model->getKeyName()],
            $model->getFillable(),
            ['created_at', 'updated_at']
        );

        $columns = "[\n";

        foreach ($getFillable as $field) {
            if (in_array($field, $model->getHidden())) {
                continue;
            }

            $title = Str::of($field)->replace('_', ' ')->ucfirst();

            $columns .= '            Column::make("'.$title.'", "'.$field.'")'."\n".'                ->sortable(),'."\n";
        }

        $columns .= '        ]';

        return $columns;
    }
}
