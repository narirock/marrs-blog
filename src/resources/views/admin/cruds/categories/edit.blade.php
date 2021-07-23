@extends('marrs-blog::admin.layouts.app')
@section('title')
    <h1><i class="fas fa-tags"></i> | CATEGORIA</h1>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::model($category, ['url' => route('admin.blog.categories.update', $category->id), 'files' => true, 'method' => 'PUT']) !!}

            @include("marrs-blog::admin.cruds.categories._form")

            {!! Form::close() !!}
        </div>
    </div>
@stop
