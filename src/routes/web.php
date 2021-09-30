<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
//'middleware' => 'webadmin',

//verificando se rota é protegida;
$guard[] = 'web';
if (config('marrs-blog.guard') != "") {
    $guard[] = config('marrs-blog.guard');
}


if (!Config::get('marrs-blog.disable.admin.routes')) {
    Route::group(
        ['prefix' => 'admin/blog', 'middleware' => $guard],
        function () {
            Route::resource('categories', 'Marrs\MarrsBlog\Http\Controllers\Admin\CategoryController', ['as' => 'admin.blog']);
            Route::resource('posts', 'Marrs\MarrsBlog\Http\Controllers\Admin\PostController', ['as' => 'admin.blog']);
        }
    );
}
if (!Config::get('marrs-blog.disable.frontend.routes')) {
    Route::group(['prefix' => 'blog', 'middleware' => ['web']], function () {
        Route::get('/', 'Marrs\MarrsBlog\Http\Controllers\Front\BlogController@index')->name('blog.index');
        Route::get('/post/{slug}', 'Marrs\MarrsBlog\Http\Controllers\Front\BlogController@post')->name('blog.post');
    });
}
