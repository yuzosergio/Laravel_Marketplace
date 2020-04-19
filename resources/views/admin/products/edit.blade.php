@extends('layouts.app')


@section('content')
<h1>Atualizar Produto</h1>
    <form action="{{route('admin.products.update',['product' => $product->id])}}" method="post" enctype="multipart/form-data">

        @csrf
        <!--faz com que caia no metodo update do controller-->
        @method("PUT");

        <div class="form-group">
            <label>Nome Produto</label>
            <input type="text" name="name" class="form-control" value="{{$product->name}}">
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description" class="form-control" value="{{$product->description}}">
        </div>
        
        <div class="form-group">
            <label>Conteúdo</label>
            <textarea name="body" id="" cols="30" rows="10" class="form-control">{{$product->body}}</textarea>
        </div>

        <div class="form-group">
            <label>Preço</label>
            <input type="text" name="price" class="form-control"value="{{$product->price}}">
        </div>

        
        <div class="form-group">
                <label>Categorias</label>
                <select name="categories[]" id="" class="form-control" multiple>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}"
                            @if($product->categories->contains($category)) selected @endif
                        >{{$category->name}}</option>
                    @endforeach
                </select>
        </div>

        <div class="form-group">
                <label>Fotos do Produto</label>
                <input type="file" name="photos[]" class="form-control @error('photos.*') is-invalid @enderror" multiple>
                @error('photos')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

        <div>
            <button type="submit" class="btn btn-lg btn-success">Atualizar Produto</button>
        </div>

    </form>

    <hr>

    <div class="row">
        @foreach($product->photos as $photo)
            <div class="col-4 text-center">
                <img src="{{asset('storage/' . $photo->image)}}" class="img-fluid" alt="">

                <form action="{{route('admin.photo.remove')}}" method="post">
                    <input type="hidden" name="photoName" value="{{$photo->image}}">
                    @csrf
                    <button style="width:100%;" type="submit" class="btn btn-lg btn-danger">Remover</button>
                </form>
            </div>
        @endforeach
    </div>

@endsection