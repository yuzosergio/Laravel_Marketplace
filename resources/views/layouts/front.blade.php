<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace L6</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <style>
        .front.row {
            margin-bottom: 40px;
        }
    </style>
    @yield('stylesheets')
</head>
<body class="bg-danger">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 40px;">

    <a class="navbar-brand" href="{{route('home')}}">Marketplace L6</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">
            <li class="nav-item @if(request()->is('/')) active @endif">
                <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            
            @foreach($categories as $category)
                <li class="nav-item @if(request()->is('category/' . $category->slug)) active @endif">
                     <a class="nav-link" href="{{route('category.single',['slug' => $category->slug])}}">{{$category->name}}</a>
                </li>
            @endforeach

        </ul>

                <div class="my-2 my-lg-0">
                    <ul class="navbar-nav mr-auto">
                        @auth
                        
                        <li class="nav-item @if(request()->is('my-orders')) active @endif">
                            
                            <a href="{{route('user.orders')}}" class="nav-link">Meus Pedidos</a>
                        </li>

                        <li class="nav-item active">
                            <!--irá procurar o form.logout-->
                            <a href="#" class="nav-link" onclick="event.preventDefault();
                                                            document.querySelector('form.logout').submit();" >Logout</a>
                            <form action="{{route('logout')}}" method="POST" style="display:none;" class="logout">
                            @csrf
                            </form>
                        </li>
                        @endauth

                        <li class="nav-item">
                            <a href="{{route('cart.index')}}" class="nav-link">
                                <!--Cria um contador ao lado do carrinho-->
                                @if(session()->has('cart')) 
                                                                    <!--//caso queira contar com a quantidade de cada produto{{array_sum(array_column(session()->get('cart'), 'amount'))}}-->
                                    <span class="badge badge-danger">{{count(session()->get('cart'))}}</span>
                                @endif
                                <i class="fa fa-shopping-cart fa-2x"></i>
                            </a>
                        </li>
                    </ul>
                </div>
  

    </div>
</nav>

<div class="container">
    @include('flash::message')
    @yield('content')
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="{{asset('js/app.js')}}"></script>

@yield('scripts')
</body>
</html>