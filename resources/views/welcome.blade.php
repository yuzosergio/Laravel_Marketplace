@extends('layouts.front')

@section('content')
<div class="row front">
    @foreach($products as $key => $product)
        <div class="col-md-4">
            <div class="card border-primary" style="width: 100%;">
                @if($product->photos->count())
                    <img style="width:345px; height:350px;" src="{{asset('storage/' . $product->photos->first()->image)}}" alt="" class="card-img-top">
                @else
                    <img style="width:345px; height:350px;" src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="card-img-top">
                @endif
                <div class="card-body">
                    <h2 class="card-title">{{$product->name}}</h2>
                    <p class="card-text">{{$product->description}}</p>
                    <h3>R$ {{number_format($product->price, '2', ',', '.')}}</h3>
                    <a href="{{route('product.single', ['slug' => $product->slug])}}" class="btn btn-success">
                        Ver Produto
                    </a>
                </div>
            </div>
        </div>
    <!--embrulha a cada col em uma row-->
    @if(($key + 1) % 3 == 0) </div><div class="row front"> @endif
    @endforeach
</div>

<div class="row">
    <div class="col-12">
        <h2>Loja Destaque</h2>
        <hr>
    </div>
    @foreach($stores as $store)
    <div class="col-4">
        @if($store->logo)
            <img style="width:250px; height:250px;" src="{{asset('storage/' . $store->logo)}}" alt="Logo da loja {{$store->name}}" class="img-fluid">
        @else
            <img src="https://via.placeholder.com/250x250.png?text=logo" alt="Loja sem logo..." class="img-fluid">
        @endif
        <h3>{{$store->name}}</h3>
        <p>{{$store->description}}</p>
       <a href="{{route('store.single', ['slug' => $store->slug])}}" class="btn btn-sm btn-success">Ver Loja</a>
    </div>
    @endforeach
</div>
@endsection