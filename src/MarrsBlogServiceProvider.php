<?php

namespace Marrs\MarrsBlog;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Marrs\MarrsBlog\Console\Commands\Install;
use Marrs\MarrsBlog\Views\Components\Posts\LastRow;
use Marrs\MarrsBlog\Views\Components\Category\Widget;
use Marrs\MarrsBlog\Views\Components\Posts\PostBlock;

class MarrsBlogServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Paginator::useBootstrap();

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'marrs-blog');

        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/marrs-blog'),
        ]);

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        $this->mergeConfigFrom(__DIR__ . '/config/config.php', 'marrs-blog');

        $this->publishes([
            __DIR__ . '/config/config.php' => config_path('marrs-blog.php')
        ], 'marrs-blog-config');

        $this->loadViewComponentsAs('marrs-blog-posts', [
            LastRow::class,
            PostBlock::class,
        ]);

        $this->loadViewComponentsAs('marrs-blog-categories', [
            Widget::class
        ]);

        $this->publishes([
            __DIR__ . '/public' => public_path('vendor/marrs-blog'),
        ], 'marrs-blog-assets');


        $this->loadCommands();
    }

    public function register()
    {
    }

    protected function loadCommands()
    {
        $this->commands([
            Install::class,
        ]);
    }
}
