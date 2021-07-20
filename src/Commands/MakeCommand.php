<?php

namespace Rappasoft\LaravelLivewireTables\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Livewire\Commands\ComponentParser;
use Livewire\Commands\MakeCommand as LivewireMakeCommand;

class MakeCommand extends Command
{
    protected $parser;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:table {name} {--force}';

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

        $force = $this->option('force');

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

    protected function ensureDirectoryExists($path)
    {
        if (! File::isDirectory(dirname($path))) {
            File::makeDirectory(dirname($path), 0777, $recursive = true, $force = true);
        }
    }

    public function classContents()
    {
        $template = file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'table.stub');

        return preg_replace_array(
            ['/\[namespace\]/', '/\[class\]/'],
            [$this->parser->classNamespace(), $this->parser->className()],
            $template
        );
    }
}
