@extends('marrs-blog::admin.layouts.app')

@section('title')
    <h1><i class="fas fa-newspaper"></i> | POST</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::model($post, ['url' => route('admin.blog.posts.update', $post->id), 'files' => true, 'method' => 'PUT']) !!}

            @include("marrs-blog::admin.cruds.posts._form")

            {!! Form::close() !!}
        </div>
    </div>
@endsection
