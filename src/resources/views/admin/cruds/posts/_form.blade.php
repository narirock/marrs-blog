@include("marrs-blog::admin.partials._error")

<div class="row">
    <div class="col-md-8 col-sm-8 col-xs-12">
        @component('marrs-blog::admin.partials.painel')
            @slot('title')
                <h3>Título da publicação</h3>
            @endslot
            @slot('body')
                <div class="form-group">
                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Titulo', 'onkeyup' => "setslug(this.value, 'slug')"]) !!}
                </div>
            @endslot
        @endcomponent

        @component('marrs-blog::admin.partials.painel')
            @slot('title')
                <h3>Conteúdo da Publicação</h3>
            @endslot
            @slot('body')
                <div class="form-group">
                    {!! Form::textarea('body', null, ['class' => 'form-control editor', 'placeholder' => 'body', 'id' => 'body']) !!}
                </div>
            @endslot
        @endcomponent

        @component('marrs-blog::admin.partials.painel')
            @slot('title')
                <h3>Excerto</h3>
            @endslot
            @slot('body')
                <div class="form-group">
                    {!! Form::textarea('excerpt', null, ['class' => 'form-control', 'placeholder' => 'Pequena descrição desta publicação', 'rows' => '3']) !!}
                </div>
            @endslot
        @endcomponent

        <!--
            @component('marrs-blog::admin.partials.painel')
                                                                                                                                                        @slot('title')
                                                                                                                                                                                                                                                                                                        <h3>Campos Adicionais</h3>
                                                                                                                                                        @endslot
                                                                                                                                                        @slot('body')

                                                                                                                                                        @endslot
        @endcomponent
        !-->

    </div>
    <div class="col-md-4 col-sm-4 col-xs-12">
        @component('marrs-blog::admin.partials.painel')
            @slot('title')
                <h3>Detalhes da publicação</h3>
            @endslot
            @slot('body')
                <div class="form-group">
                    {!! Form::label('slug', 'Url slug') !!}
                    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'slug']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('status', 'Status da Publicação') !!}
                    {!! Form::select('status', $status, null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('category_id', 'Categoria da Publicação') !!}
                    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('publish', 'Publicar em') !!}
                    {!! Form::date('publish', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('featured', 'Destacado') !!}
                    {!! Form::checkbox('featured', null, ['class' => 'form-control']) !!}
                </div>
            @endslot
        @endcomponent

        @component('marrs-blog::admin.partials.painel')
            @slot('title')
                <h3>Publicar imagem</h3>
            @endslot
            @slot('body')
                <div class="container">
                    @if (@$post->image != '')
                        <div class="form-group">
                            <img src="/{{ $post->image }}" width="100%" />
                        </div>
                    @endif
                    <div class="form-group">
                        {!! Form::file('image', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            @endslot
        @endcomponent

        @component('marrs-blog::admin.partials.painel')
            @slot('title')
                <h3>Conteúdo do SEO</h3>
            @endslot
            @slot('body')
                <div class="form-group">
                    {!! Form::label('meta_description', 'Meta de Descrição') !!}
                    {!! Form::textarea('meta_description', null, ['class' => 'form-control', 'placeholder' => '', 'rows' => '2']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('meta_keywords', 'Meta de palavras-chave') !!}
                    {!! Form::textarea('meta_keywords', null, ['class' => 'form-control', 'placeholder' => '', 'rows' => '2']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('seo_title', 'Título SEO') !!}
                    {!! Form::text('seo_title', null, ['class' => 'form-control']) !!}
                </div>
            @endslot
        @endcomponent

    </div>
</div>

<div>
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('admin.blog.posts.index') }}" class="btn btn-danger">Fechar</a>
</div>
