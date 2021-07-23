<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card-search">
                    <form action="{{ route('blog.index') }}" id="blog_search" method="GET">
                        <div class="input-group mb-3">
                            <div class="text-center search-icon"></div>
                            <input type="search" class="form-control" placeholder="Pesquise uma notícia aqui..."
                                aria-label="Recipient's username" aria-describedby="basic-addon2" name="term"
                                value="{{ @$_GET['term'] }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button"
                                    onclick="$('#blog_search').submit()">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
