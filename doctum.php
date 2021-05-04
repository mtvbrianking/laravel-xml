<?php

require __DIR__.'/vendor/autoload.php';

use Doctum\Doctum;
use Doctum\RemoteRepository\GitHubRemoteRepository;
use Doctum\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$dir = __DIR__.'/src';

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('tests')
    ->exclude('vendor')
    ->in($dir);

$versions = GitVersionCollection::create($dir)
    ->add('master', 'Master branch');

$repo = new GitHubRemoteRepository(
    'mtvbrianking/laravel-xml',
    dirname($dir),
    'https://github.com/'
);

$options = [
    'theme' => 'default',
    'versions' => $versions,
    'title' => 'Laravel XML',
    'build_dir' => __DIR__.'/build/docs',
    'cache_dir' => __DIR__.'/build/docs/cache',
    'remote_repository' => $repo,
    'default_opened_level' => 3,
];

return new Doctum($iterator, $options);
