<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/bootstrap/app.php';

return (new MattAllan\LaravelCodeStyle\Config())
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in(app_path())
            ->in(config_path())
            ->in(database_path('factories'))
            ->in(database_path('seeds'))
            ->in(database_path('migrations'))
            ->in(base_path('routes'))
            ->in(base_path('tests'))
            ->name('ide_help')
    )
    ->setRules([
        '@Laravel' => true,
        '@Laravel:risky' => true,
        'concat_space' => [
            'spacing' => 'one'
        ],
        'explicit_string_variable' => true,
    ]);
