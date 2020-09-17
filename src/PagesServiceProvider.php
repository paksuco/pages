<?php

namespace Paksuco\Pages;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class PagesServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->handleConfigs();
        $this->handleMigrations();
        $this->handleViews();
        $this->handleTranslations();
        $this->handleRoutes();
        $this->handleResources();

        Event::listen("paksuco.menu.beforeRender", function ($key, $container) {
            if ($key == "admin") {
                if ($container->hasItem("Pages") == false) {
                    $container->addItem(
                        "Pages",
                        route("paksuco.pages.index"),
                        "fa fa-copy",
                        null,
                        config("pages-ui.backend.menu_priority", 30)
                    );
                }
            }
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Bind any implementations.
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function handleConfigs()
    {
        $configPath = __DIR__ . '/../config/pages-ui.php';

        $this->publishes([
            $configPath =>
            base_path('config/pages-ui.php'),
        ], "config");

        $this->mergeConfigFrom($configPath, 'pages-ui');
    }

    private function handleTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'pages-ui');
    }

    private function handleViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../views', 'pages-ui');

        $this->publishes([
            __DIR__ . '/../views' =>
            base_path('resources/views/vendor/pages-ui'),
        ], "views");
    }

    private function handleResources()
    {
        $this->publishes([
            __DIR__ . '/../resources/js/tinymce' =>
            base_path('public/assets/vendor/tinymce'),
        ], "pages-tinymce");
    }

    private function handleMigrations()
    {
        $this->publishes([
            __DIR__ . '/../migrations' =>
            base_path('database/migrations'),
        ], "migrations");
    }

    private function handleRoutes()
    {
        include __DIR__ . '/../routes/routes.php';
    }
}
