<?php

namespace Marrs\MarrsBlog;

use Illuminate\Support\ServiceProvider;
use Marrs\MarrsBlog\Views\Components\Category\Widget;
use Marrs\MarrsBlog\Views\Components\Posts\LastRow;
use Marrs\MarrsBlog\Views\Components\Posts\PostBlock;

class MarrsBlogServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'marrs-blog');

        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/marrs-blog'),
        ]);

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        $this->mergeConfigFrom(__DIR__ . '/config/config.php', 'marrs-blog');

        $this->publishes([
            __DIR__ . '/config/config.php' => config_path('marrs-blog.php')
        ], 'marrs-blog');

        $this->loadViewComponentsAs('marrs-blog-posts', [
            LastRow::class,
            PostBlock::class,
        ]);

        $this->loadViewComponentsAs('marrs-blog-categories', [
            Widget::class
        ]);
    }

    public function register()
    {
    }
}
