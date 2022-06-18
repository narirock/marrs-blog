# 🚀 MARRS BLOG

Este pacote foi desenvolvido para facilitar a criação de um blog simples.
Ao instala-lo na aplicação ele provisiona:
  - Cadastro de categorias
  - Cadastro de postagens
  - Pagina de postagens
  - Busca de postagens
  - Widget de categorias

Instalação
---
```cmd

composer require narirock/marrs-blog
```

no arquivo config/app.php inclua o service proovider

```php
/*
* Package Service Providers...
*/
Marrs\MarrsBlog\MarrsBlogServiceProvider::class,
```
para rodar as migrations e seeders necessárias rode o comando:
```terminal
php artisan marrs-blog:install  
```

alguns posts e categorias de teste serão criados automaticamente.
