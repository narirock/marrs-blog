<div>
    <section class="ftco-section blog-section">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">Blog / Notícias</span>
                    <h2>Confira nossas últimas postagens</h2>
                </div>
            </div>
            <div class="row">
                @foreach ($posts as $post)
                    <!-- Card Blog -->
                    <x-marrs-blog-posts-post-block :post="$post" />
                @endforeach
            </div>

        </div>
    </section>

</div>
