<div class="form-group">
    {!! Form::label('name', 'Nome') !!}
    {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>"Nome", "onkeyup"=>"setslug(this.value, 'slug')"]) !!}
</div>
    
<div class="form-group">
    {!! Form::label('slug', 'Slug') !!}
    {!! Form::text('slug', null, ['class'=>'form-control', 'placeholder'=>"Slug"]) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Descrição') !!}
    {!! Form::textarea('description', null, ['class'=>'form-control', 'placeholder'=>"Descrição"]) !!}
</div>
<div class="row">
    <div class="col col-md-6">
        <div class="form-group">
            @if(@$category)
            <img src="/{{$category->image}}" alt="" width="450"><br>
            @endif
            {!! Form::label('image', 'Imagem') !!}
            {!! Form::file('image', null, ['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="col col-md-6">
        <div class="form-group">
            {!! Form::label('category_id', 'Categoria Pai') !!}
            {!! Form::select('category_id', $categories, null, ['class'=>'form-control']) !!}
        </div>
                
        <div class="form-group">
            {!! Form::label('enable', 'Habilitado') !!}
            {!! Form::select('enable', ['1'=>'Sim', '0'=>'Não'], null, ['class'=>'form-control']) !!}
        </div>

    </div>

</div>

    
<div>
    {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
    <a href="{{ route('categories.index')}}" class="btn btn-danger">Fechar</a>
</div>