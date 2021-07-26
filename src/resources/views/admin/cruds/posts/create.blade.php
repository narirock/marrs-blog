@extends(Config::get('marrs-blog.template.admin'))

@section('title')
    <h1><i class="fas fa-newspaper"></i> | POST</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['url' => route('admin.blog.posts.store'), 'files' => true]) !!}

            @include("marrs-blog::admin.cruds.posts._form")

            {!! Form::close() !!}
        </div>
    </div>
@endsection
