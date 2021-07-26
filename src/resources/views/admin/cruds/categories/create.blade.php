@extends(Config::get('marrs-blog.template.admin'))
@section('title')
    <h1><i class="fas fa-tags"></i> | CATEGORIA</h1>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['url' => route('admin.blog.categories.store'), 'files' => true]) !!}

            @include("marrs-blog::admin.cruds.categories._form")

            {!! Form::close() !!}
        </div>
    </div>
@stop
