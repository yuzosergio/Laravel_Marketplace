<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace L6</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    </head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom:40px;">
  <a class="navbar-brand" href="{{route('home')}}">Marketplace L6</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  @auth
    <ul class="navbar-nav mr-auto">
                                          <!--* na frente faz com que retorne true ativando o item atual do navbar-->
      <li class="nav-item @if(request()->is('admin/stores*')) active @endif">
        <a class="nav-link" href="{{route('admin.stores.index')}}">Lojas <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item @if(request()->is('admin/products*')) active @endif">
        <a class="nav-link" href="{{route('admin.products.index')}}">Produtos</a>
      </li>
      <li class="nav-item @if(request()->is('admin/categories*')) active @endif">
        <a class="nav-link" href="{{route('admin.categories.index')}}">Categorias</a>
      </li>
    </ul>

    <div class="my-2 my-lg-0">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
                                        <!--irá procurar o form.logout-->
        <a href="#" class="nav-link" onclick="event.preventDefault();
                                             document.querySelector('form.logout').submit();" >Logout</a>
        <form action="{{route('logout')}}" method="POST" style="display:none;" class="logout">
            @csrf
        </form>
      </li>
      <li class="nav-item">
          <span class="nav-link">Bem Vindo(a) {{auth()->user()->name}}!</span>
      </li>
    </ul>
    </div>
    @endauth
  </div>
</nav>
    <div class="container">
        @include('flash::message')
        <!--adicionado na sessão do create.blade e index.blade-->
        @yield('content')
    </div>
</body>
</html>