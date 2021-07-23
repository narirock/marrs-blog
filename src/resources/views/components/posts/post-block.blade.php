<div class="col-12 col-sm-8 col-md-6 col-lg-{{ $lg }} mb-30">
    <div class="card">
        <a href="#">
            <figure class="blog-card-header" style="background-image: url('/{{ $post->image }}')" role="img"
                aria-label="[Texto para imagem]"></figure>
        </a>
        <div class="blog-category">
            <a href="/blog/?category={{ $post->category->id }}" class="btn btn-primary btn-sm"
                title="{{ $post->category->name }}">{{ $post->category->name }}</a>
        </div>
        <div class="card-body">
            <h4 class="card-title">{!! $post->title !!}</h4>
            <small class="text-muted cat">
                <i class="far fa-calendar text-info"></i>
                {{ Carbon\Carbon::create($post->publish)->format('d/m/Y') }}
                <i class="fas fa-users text-info"></i> {{ @$post->author->name }}
            </small>
            <p class="card-text">{!! $post->excerpt !!}</p>

            <a href="/blog/post/{{ $post->slug }}" class="btn btn-outline-info btn-block"
                title="Ler - {{ $post->title }}">Ver
                matéria</a>
        </div>
    </div>
</div>
