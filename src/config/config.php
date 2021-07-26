<?php

return [
    "template" => [
        "admin" => "marrs-blog::admin.layouts.app",
        "front" => "marrs-blog::front.template"
    ],
    //variaveis para meta tags da index do blog
    "name" => env('APP_NAME') . " - Blog",
    "description" => "Descrição pagina geral do blog",
    "seo_image" => env('APP_URL') . "/site/images/seo.png"
];
