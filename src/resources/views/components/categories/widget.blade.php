<div class="widget-side">
    <div class="widget-header">
        <h3 class="widget-title"><i class="fas fa-stream"></i> | Categorias de notícias</h3>
    </div>
    <div class="widget-body">
        <ul class="category-links">
            @foreach ($categories as $category)
                <li><i class="fas fa-chevron-right"></i> <a
                        href="/blog?category={{ $category->id }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
    </div>
</div>
