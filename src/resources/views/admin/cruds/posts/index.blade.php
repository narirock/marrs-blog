@extends('marrs-blog::admin.layouts.app')

@section('title')
    <h1><i class="fas fa-newspaper"></i> | POSTS</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['url' => route('admin.blog.posts.index'), 'method' => 'GET', 'id' => 'form_filter']) !!}
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                <div class="dataTables_length" id="DataTables_Table_0_length">
                    <label><select name="show" class="" onchange="$('#form_filter').submit()">
                            <option value="10" {{ $show == 10 ? "selected='selected'" : '' }}>10</option>
                            <option value="25" {{ $show == 25 ? "selected='selected'" : '' }}>25</option>
                            <option value="50" {{ $show == 50 ? "selected='selected'" : '' }}>50</option>
                            <option value="100" {{ $show == 100 ? "selected='selected'" : '' }}>100</option>
                        </select> resultados por página</label>
                </div>
                <div id="DataTables_Table_0_filter" class="dataTables_filter">
                    <label>Pesquisar<input type="search" name="term" value="{{ @$term }}" class=""
                            placeholder="Procure aqui"></label>
                </div>
            </div>
            {!! Form::close() !!}
            <table class="table form-table table-main data-table-custom">
                <thead>
                    <tr>
                        <th><a href="/{{ Route::getFacadeRoot()->current()->uri() .
    '?order=title&term=' .
    @$term .
    '&show=' .
    $show }}"
                                class="{{ @$order == 'title' ? 'active' : '' }}">Titulo</a></th>
                        <th><a href="/{{ Route::getFacadeRoot()->current()->uri() .
    '?order=created_at&term=' .
    @$term .
    '&show=' .
    $show }}"
                                class="{{ @$order == 'created_at' ? 'active' : '' }}">Ciação</a></th>
                        <th width="200" class="text-center">
                            <a href="{{ route('admin.blog.posts.create') }}" class="btn btn-success">Novo</a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.blog.posts.edit', $post->id) }}"
                                    class="btn btn-info btn-sm">Editar</a>
                                <a href="#" data-toggle="modal" data-target="#confirm-delete-{{ $post->id }}"
                                    class="btn btn-danger  btn-sm">Excluir</a>
                                @push('modals')
                                    <form action="{{ route('admin.blog.posts.destroy', $post->id) }}" method="post">
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        <div class="modal fade" id="confirm-delete-{{ $post->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">Atenção</div>
                                                    <div class="modal-body">Deseja remover o post {{ $post->title }} ?</div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Não</button>
                                                        <input href="{{ route('admin.blog.posts.destroy', $post->id) }}"
                                                            class="btn btn-danger" type="submit" value="Sim" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endpush
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $posts->appends(request()->query())->links('admin.layouts.components.paginator') }}
        </div>
    </div>
@endsection
