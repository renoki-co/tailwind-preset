<?php

namespace RenokiCo\TailwindPreset;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Laravel\Ui\UiCommand;

class TailwindPresetServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        UiCommand::macro('tailwindcss', function ($command) {
            Preset::install();

            $command->info('Tailwind CSS scaffolding installed!');

            if ($command->option('auth')) {
                TailwindCssPreset::installAuth();

                $command->info('Tailwind CSS auth scaffolding installed successfully.');
            }

            $command->comment('Please run "npm install && npm run dev" to compile your scaffolding.');
        });

        Paginator::defaultView('pagination::default');

        Paginator::defaultSimpleView('pagination::simple-default');
    }
}
