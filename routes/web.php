<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{slug}', 'HomeController@single')->name('product.single');

Route::prefix('cart')->name('cart.')->group(function(){
    Route::get('/', 'CartController@index')->name('index');
    Route::post('add', 'CartController@add')->name('add');

    Route::get('remove/{slug}', 'CartController@remove')->name('remove');
    Route::get('cancel', 'CartController@cancel')->name('cancel');
});

Route::prefix('checkout')->name('checkout.')->group(function(){
    Route::get('/', 'CheckoutController@index')->name('index');
});
//Controle de acesso de produto e lojas apenas para administradores, sugere login automaticamente quando está na rota produto ou loja
Route::group(['middleware'=>['auth']],function(){

    //admin/stores              admin.stores.        Admin//StoreController
Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){
    // /stores/create      store.index
/*   Route::prefix('stores')->name('stores.')->group(function(){

Route::get('/','StoreController@index')->name('index');
Route::get('/create','StoreController@create')->name('create');
Route::post('/store','StoreController@store')->name('store');
Route::get('/{store}/edit','StoreController@edit')->name('edit');
Route::post('/update/{store}','StoreController@update')->name('update');
Route::get('/destroy/{store}', 'StoreController@destroy')->name('destroy');
});
*/
Route::resource('stores', 'StoreController');
Route::resource('products','ProductController');
Route::resource('categories','CategoryController');

Route::post('photos/remove', 'ProductPhotoController@removePhoto')->name('photo.remove');
});
});

Auth::routes();

Route::get('/model', function(){
    //$users =\App\User::all(); //select * from users

   // $user = new \App\User();
   //$user = \App\User::find(1);
   // $user->name = 'Usuario Teste Etidato';
    //$user->save();
    /*Apenas de estar retornando um all, retorna em json*/
   //return \App\User::all(); //collection

   /*retorna usuario com base no id*/
   //return\App\User::find(3);
                                                            /*->first() retorna o primeiro resultado*/
  // return \App\User::where('name', 'Mozelle Runolfsdottir Jr.')->get();

    /*Retorna os json paginados*/ 
   //return \App\User::paginate(10);

   /*Exibe os dados que foram inseridos
   $user =  \App\User::create([
       'name' => 'Mário Sérgio',
       'email' => 'emal.example@gmail.com',
       'password' => bcrypt('12345678')
   ]);
   dd($user);*/

   /*Mass Update*/
   /*$user = \App\User::find(41);
   $user->update([
       'name' => 'Mário Komorisono'
   ]);
   dd($user);*/
/*
    //COMO FARIA PARA PEGAR A LOJA DE UM USUARIO?
   $user = \App\User::find(41);

   //return $user->store;
   //dd($user->store()->count()); //Quantas lojas o usuario tem
*/
    //COMO PEGAR OS PRODUTOS DE UMA LOJA?
   //$loja= \App\Store::find(1);
    //return $loja->products->count();
   //return $loja->products | $loja->products()->where('id',9)->get();
   
   //PEGAR LOJAS DE UMA CATEGORIA DE UMA LOJA
  // $categoria = \App\Category::find(1);
  // $categoria->products;
/*
  //Criar uma loja para um usuario
    $user = \App\User::find(10);
    $store = $user->store()->create([
        'name' => 'Loja Teste',
        'description' => 'loja Teste de produtos de informatica',
        'mobile_phone' => 'xx-xxx-xxx',
        'phone' => 'xxx-xxx-xxxx',
        'slug' => 'loja-teste',
    ]);

    dd($store);*/
/*
  //Criar um produto para uma loja
        $store = \App\Store::find(41);
        $product = $store->products()->create([
            'name' => 'Notebook Dell',
            'description' => 'Core i5 12gb',
            'body' => 'qualquer coisa..',
            'price' => 2999.99,
            'slug' => 'notebook-dell',
        ]);
        dd($product);*/

  //Criar uma categoria
/*
            \App\Category::create([
                'name' => 'Games',
                'description'=> 'qualque coisa...',
                'slug' => 'games',
            ]);

            \App\Category::create([
                'name' => 'Notebooks',
                'description'=> 'qualque coisa...',
                'slug' => 'notebook',
            ]);
            
            return \App\Category::all();
    */
    /*
    //ADICIONAR UM PRODUTO PARA UMA CATEGORIA OU VICE-VERSA

    $product = \App\Product::find(42);

    dd($product->categories()->attach([7]));//junta o produto 42 com a categoria 7
    dd($product->categories()->sync([8]));//altera a categoria e remove a anterior
            
*/
   return \App\User::all();
   
});


//Route::get('/home', 'HomeController@index')->name('home');//->middleware('auth');
