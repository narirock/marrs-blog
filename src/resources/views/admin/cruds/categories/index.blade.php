@extends(Config::get('marrs-blog.template.admin'))

@section('title')
    <h1><i class="fas fa-tags"></i> | CATEGORIAS</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table form-table table-main data-table">
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Categoria Pai</th>
                        <th width="150" class="text-center">
                            <a href="{{ route('admin.blog.categories.create') }}" class="btn btn-success  btn-sm">Novo</a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            @if ($category->category)
                                <td>{{ $category->category['name'] }}</td>
                            @else
                                <td class="text-center"> - </td>
                            @endif
                            <td>
                                <a href="{{ route('admin.blog.categories.edit', $category->id) }}"
                                    class="btn btn-info btn-sm">Editar</a>
                                <a href="#" data-toggle="modal" data-target="#confirm-delete-{{ $category->id }}"
                                    class="btn btn-danger  btn-sm">Excluir</a>
                                @push('modals')
                                    <form action="{{ route('admin.blog.categories.destroy', $category->id) }}" method="post">
                                        <input type="hidden" name="_method" value="delete" />
                                        {!! csrf_field() !!}
                                        <div class="modal fade" id="confirm-delete-{{ $category->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">Atenção</div>
                                                    <div class="modal-body">Deseja remover a categoria {{ $category->name }} ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Não</button>
                                                        <input
                                                            href="{{ route('admin.blog.categories.destroy', $category->id) }}"
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
        </div>
    </div>
@stop
