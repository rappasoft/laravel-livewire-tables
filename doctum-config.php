<?php

use Doctum\Doctum;
use Doctum\RemoteRepository\GitHubRemoteRepository;
use Doctum\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$dir = './src';

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('Resources')
    ->exclude('Tests')
    ->in($dir);

// generate documentation for all v2.0.* tags, the 2.0 branch, and the main one
$versions = GitVersionCollection::create($dir)
    // In a non case-sensitive way, tags containing "PR", "RC", "BETA" and "ALPHA" will be filtered out
    // To change this, use: `$versions->setFilter(static function (string $version): bool { // ... });`
    ->add('master', '3.x branch')
    ->add('v2-master', '2.x branch')
    ->add('v1', '1.x branch');

return new Doctum($iterator, [
    'versions' => $versions,
    'title' => 'Rappasoft - Laravel Livewire Tables',
    'build_dir' => __DIR__.'/build/%version%',
    'cache_dir' => __DIR__.'/cache/%version%',
    'source_dir' => dirname($dir).'/',
    'remote_repository' => new GitHubRemoteRepository('rappasoft/laravel-livewire-tables', dirname($dir)),
    'default_opened_level' => 2, // optional, 2 is the default value
]);
