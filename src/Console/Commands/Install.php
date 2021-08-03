<?php

namespace Marrs\MarrsBlog\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Marrs\MarrsBlog\Models\Post;
use Marrs\MarrsBlog\Models\Category;
use Illuminate\Support\Facades\Artisan;
use Marrs\MarrsAdmin\Models\Menu;

class Install extends Command
{
    protected $signature = 'marrs-blog:install';

    protected $description = 'instala e configura o pacote marrs-blog';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->warn('1. Criando tabelas');
        Artisan::call('migrate');
        $this->info(Artisan::output());

        $this->warn('2. Criando registros iniciais');
        $this->seeder();

        $this->warn('3. Publicando assets');
        Artisan::call('vendor:publish --tag=marrs-blog-assets --force');
    }


    public function seeder()
    {
        //menus do modulo
        $blmenu = Menu::create([
            'name' => 'Blog',
            'route' => null,
            'icon_class' => 'fas fa-rss',
            'type' => 'menu',
            'menu_id' => 1
        ]);
        Menu::insert([
            [
                'name' => 'Categorias',
                'route' => 'admin.blog.categories.index',
                'icon_class' => 'fas fa-chart-line',
                'type' => 'menu',
                'menu_id' => $blmenu->id
            ],
            [
                'name' => 'Posts',
                'route' => 'admin.blog.posts.index',
                'icon_class' => 'fas fa-newspaper',
                'type' => 'menu',
                'menu_id' => $blmenu->id
            ]
        ]);

        for ($i = 1; $i <= 3; $i++) {
            Category::create([
                'name' => "Categoria {$i}",
                'slug' => "categoria{$i}"
            ]);
        }

        for ($i = 1; $i <= 20; $i++) {
            Post::create([
                'title' => "Post {$i}",
                'seo_title' => "post{$i}",
                'publish' => '2020-01-01',
                'excerpt' => "post{$i}",
                'body' => "post{$i}",
                'image' => '/i.picsum.photos/id/1011/5472/3648.jpg?hmac=Koo9845x2akkVzVFX3xxAc9BCkeGYA9VRVfLE4f0Zzk',
                'slug' => "post{$i}",
                'category_id' => rand(1, 3),
                'status' => 'PUBLISHED',
                'author_id' => 1
            ]);
        }
    }
}
