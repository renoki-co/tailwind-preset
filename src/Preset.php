<?php

namespace RenokiCo\TailwindPreset;

use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Laravel\Ui\Presets\Preset as BasePreset;
use Symfony\Component\Finder\SplFileInfo;

class Preset extends BasePreset
{
    /**
     * Install the preset.
     *
     * @return void
     */
    public static function install()
    {
        static::updatePackages();

        static::updateStyles();

        static::updateBootstrapping();

        static::removeWelcomePage();

        static::updatePagination();

        static::removeNodeModules();
    }

    /**
     * Install the Authentication scaffolding.
     *
     * @return void
     */
    public static function installAuth()
    {
        static::scaffoldController();
        static::scaffoldAuth();
    }

    /**
     * Update package.json.
     *
     * @param  array  $packages
     * @return void
     */
    protected static function updatePackageArray(array $packages)
    {
        return array_merge([
            'laravel-mix' => '^5.0.1',
            'laravel-mix-tailwind' => '^0.1.0',
            'tailwindcss' => '^1.4',
            '@tailwindcss/custom-forms' => '^0.2',
        ], Arr::except($packages, [
            'bootstrap',
            'bootstrap-sass',
            'popper.js',
            'laravel-mix',
            'jquery',
        ]));
    }

    /**
     * Update the CSS/SASS files.
     *
     * @return void
     */
    protected static function updateStyles()
    {
        tap(new Filesystem, function ($filesystem) {
            $filesystem->deleteDirectory(resource_path('sass'));

            $filesystem->delete(public_path('js/app.js'));

            $filesystem->delete(public_path('css/app.css'));

            if (! $filesystem->isDirectory($directory = resource_path('css'))) {
                $filesystem->makeDirectory($directory, 0755, true);
            }
        });

        copy(__DIR__.'/stubs/resources/css/app.css', resource_path('css/app.css'));
    }

    /**
     * Update configuration files for bootstrapping.
     *
     * @return void
     */
    protected static function updateBootstrapping()
    {
        copy(__DIR__.'/stubs/tailwind.config.js', base_path('tailwind.config.js'));

        copy(__DIR__.'/stubs/webpack.mix.js', base_path('webpack.mix.js'));

        copy(__DIR__.'/stubs/resources/js/bootstrap.js', resource_path('js/bootstrap.js'));
    }

    /**
     * Ensure the pagination files are replaced.
     *
     * @return void
     */
    protected static function updatePagination()
    {
        (new Filesystem)->delete(resource_path('views/vendor/paginate'));

        (new Filesystem)->copyDirectory(__DIR__.'/stubs/resources/views/vendor/pagination', resource_path('views/vendor/pagination'));
    }

    /**
     * Remove the welcome page that comes by default.
     *
     * @return void
     */
    protected static function removeWelcomePage()
    {
        (new Filesystem)->delete(resource_path('views/welcome.blade.php'));
    }

    /**
     * Copy the Auth controllers.
     *
     * @return void
     */
    protected static function scaffoldController()
    {
        if (! is_dir($directory = app_path('Http/Controllers/Auth'))) {
            mkdir($directory, 0755, true);
        }

        $filesystem = new Filesystem;

        collect($filesystem->allFiles(base_path('vendor/laravel/ui/stubs/Auth')))
            ->each(function (SplFileInfo $file) use ($filesystem) {
                $filesystem->copy(
                    $file->getPathname(),
                    app_path('Http/Controllers/Auth/'.Str::replaceLast('.stub', '.php', $file->getFilename()))
                );
            });
    }

    /**
     * Copy the Authentication migrations and views.
     *
     * @return void
     */
    protected static function scaffoldAuth()
    {
        file_put_contents(
            app_path('Http/Controllers/HomeController.php'), static::compileControllerStub()
        );

        file_put_contents(
            base_path('routes/web.php'),
            "Auth::routes();\n\nRoute::get('/home', 'HomeController@index')->name('home');\n\n",
            FILE_APPEND
        );

        tap(new Filesystem, function ($filesystem) {
            $filesystem->copyDirectory(__DIR__.'/stubs/resources/views', resource_path('views'));

            collect($filesystem->allFiles(base_path('vendor/laravel/ui/stubs/migrations')))
                ->each(function (SplFileInfo $file) use ($filesystem) {
                    $filesystem->copy(
                        $file->getPathname(),
                        database_path('migrations/'.$file->getFilename())
                    );
                });
        });
    }

    /**
     * Set up HomeController.
     *
     * @return void
     */
    protected static function compileControllerStub()
    {
        return str_replace(
            '{{namespace}}',
            Container::getInstance()->getNamespace(),
            file_get_contents(__DIR__.'/stubs/controllers/HomeController.stub')
        );
    }
}
