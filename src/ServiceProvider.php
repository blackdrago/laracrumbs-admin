<?php
/**
 * Contains the ServiceProvider class.
 *
 * @package LaracrumbsAdmin
 * @author  K. McCormick <kyliemccormick@gmail.com>
 */
namespace LaracrumbsAdmin;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Blade;
use Laracrumbs\Conductor;

/**
 * ServiceProvider for LaracrumbsAdmin, the UI management wrapper for Laracrumbs.
 *
 * @see https://laravel.com/docs/5.6/providers Service Providers
 */
class ServiceProvider extends BaseServiceProvider
{
    /** @var string $sourceDir          The package's source code directory. */
    private $sourceDir = __DIR__;

    /** @var string $packageKey         The package key for translations, views, etc. */
    private $packageKey = 'laracrumbs-admin';

    /**
     * Bootstrap services for Laracrumbs.
     */
    public function boot()
    {
        // translations and language strings
        $langPath = $this->getSourcePath(['resources', 'lang']);
        $this->loadTranslationsFrom($langPath, $this->packageKey);

        // Blade templates and views
        $viewPath = $this->getSourcePath(['resources', 'views']);
        $this->loadViewsFrom($viewPath, $this->packageKey);

        // publishes language strings, config, and views for override capability
        $publicPath = $this->getSourcePath(['public']);
        $configPath = $this->getSourcePath(['config', "{$this->packageKey}.php"]);
        $this->publishes([$publicPath => public_path("vendor/{$this->packageKey}")], 'public');
        $this->publishes([$configPath => config_path("{$this->packageKey}.php")], 'config');

        // register the laracrumbs
        $this->registerLaracrumbs();
    }

    /**
     * Register services for Laracrumbs.
     */
    public function register()
    {
        $this->loadRoutesFrom($this->getSourcePath(['routes', 'web.php']));
    }

    /**
     * Register the custom Laracrumbs for this application.
     */
    public function registerLaracrumbs()
    {
        $crumbfile = $this->getSourcePath(['routes', 'laracrumbs.php']);
        require $crumbfile;
    }

    /**
     * Given the relative path, return the full source code path.
     *
     * @param  array  $relpath
     * @return string
     */
    public function getSourcePath($relpath)
    {
        array_unshift($relpath, $this->sourceDir);
        return join(\DIRECTORY_SEPARATOR, $relpath);
    }

    /**
     * Get the services provided by LaracrumbsAdmin ServiceProvider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
