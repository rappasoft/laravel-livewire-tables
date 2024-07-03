<?php

namespace Rappasoft\LaravelLivewireTables\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Features\SupportConsoleCommands\Commands\ComponentParser;
use Livewire\Features\SupportConsoleCommands\Commands\MakeCommand as LivewireMakeCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

use function Laravel\Prompts\suggest;
use function Laravel\Prompts\text;

/**
 * Class MakeCommand
 */
class MakeCommand extends Command implements PromptsForMissingInput
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

    protected function ensureDirectoryExists(string $path): void
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
            $filename = rtrim($this->modelPath, '/').'/'.$this->model.'.php';
            if (File::exists($filename)) {
                //In case the file has more than one class which is highly unlikely but still possible
                $classes = array_filter($this->getClassesList($filename), function ($class) {
                    return substr($class, strrpos($class, '\\') + 1) == $this->model;
                });
                if (count($classes) == 1) {
                    return $classes[0];
                }
            }
        }

        $this->error('Could not find path to model.');

        return 'App\Models\\'.$this->model;
    }

    /*
    * Credits to Harm Smits: https://stackoverflow.com/a/67099502/2263114
    */
    private function getClassesList(string $file): array
    {
        $classes = [];
        $namespace = '';
        $tokens = \PhpToken::tokenize(file_get_contents($file));

        for ($i = 0; $i < count($tokens); $i++) {
            if ($tokens[$i]->getTokenName() === 'T_NAMESPACE') {
                for ($j = $i + 1; $j < count($tokens); $j++) {
                    if ($tokens[$j]->getTokenName() === 'T_NAME_QUALIFIED') {
                        $namespace = $tokens[$j]->text;
                        break;
                    }
                }
            }

            if ($tokens[$i]->getTokenName() === 'T_CLASS') {
                for ($j = $i + 1; $j < count($tokens); $j++) {
                    if ($tokens[$j]->getTokenName() === 'T_WHITESPACE') {
                        continue;
                    }

                    if ($tokens[$j]->getTokenName() === 'T_STRING') {
                        $classes[] = $namespace.'\\'.$tokens[$j]->text;
                    } else {
                        break;
                    }
                }
            }
        }

        return $classes;
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

        $getFillable = [
            ...[$model->getKeyName()],
            ...$model->getFillable(),
            ...['created_at', 'updated_at'],
        ];

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

    protected function possibleModels(): array
    {
        $modelPath = is_dir(app_path('Models')) ? app_path('Models') : app_path();

        return collect(Finder::create()->files()->depth(0)->in($modelPath))
            ->map(fn ($file) => $file->getBasename('.php'))
            ->sort()
            ->values()
            ->all();
    }

    protected function promptForMissingArguments(InputInterface $input, OutputInterface $output): void
    {

        if ($this->didReceiveOptions($input)) {
            return;
        }

        if (trim($this->argument('name')) === '') {
            $name = text('What is the name of your Livewire class?', 'TestTable');

            if ($name) {
                $input->setArgument('name', $name);
            }
        }

        if (trim($this->argument('model')) === '') {
            $model = suggest(
                'What is the name of the model you want to use in this table?',
                $this->possibleModels(),
                'Test'
            );

            if ($model) {
                $input->setArgument('model', $model);
            }
        }

        if (trim($this->argument('modelpath')) === '' && ! in_array($this->argument('model'), $this->possibleModels())) {

            $modelPath = text('What is the path to the model you want to use in this table?', 'app/TestModels/');

            if ($modelPath) {
                $input->setArgument('modelpath', $modelPath);
            }
        }
    }
}
