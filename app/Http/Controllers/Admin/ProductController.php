<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\ProductRequest;
use App\Traits\UploadTrait;

class ProductController extends Controller
{
    use UploadTrait;
    private $product;
    public function __construct(Product $product){
        $this->product = $product;
    }

    public function index()
    {
        $user = auth()->user();

        if(!$user->store()->exists()){

            flash('É preciso cria uma loja para cadastrar produtos!')->warning();
            return redirect()->route('admin.stores.index');
        } 
     
        $products = $user->store->products()->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = \App\Category::all(['id','name']);

        return view('admin.products.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {

        $data = $request->all();
        $categories = $request->get('categories',null);

        $data['price'] = formatPriceToDatabase($data['price']);

        $store = auth()->user()->store;
        $product = $store->products()->create($data);
        //salva
        $product->categories()->sync($categories);

        //só vai ser executado quando mandar a imagem para controller
        if($request->hasFile('photos')){
            $images = $this->imageUpload($request->file('photos'), 'image');
            //inserção destas imagens/referencia na base
            $product->photos()->createMany($images);
        }

        flash('Produto criado com sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

    public function show($id)
    {
      
    }

    public function edit($product)
    {                               //busque ou falhe
        $product = $this->product->findOrFail($product);
        $categories = \App\Category::all(['id','name']);

        return view('admin.products.edit', compact('product','categories'));
    }

   
    public function update(ProductRequest $request, $product)
    {
        $data = $request->all();
        $categories = $request->get('categories',null);

        $product = $this->product->find($product);
        $product->update($data);

        if(!is_null($categories))
        $product->categories()->sync($categories);

        if($request->hasFile('photos')){
            $images = $this->imageUpload($request->file('photos'), 'image');
            //inserção destas imagens/referencia na base
            $product->photos()->createMany($images);
        }

        flash('Produto atualizado com sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

   
    public function destroy($product)
    {
       
        $product = $this->product->find($product);
        $product->delete();

        flash('Produto removido com sucesso!')->warning();
        return redirect()->route('admin.products.index');
    }

    
}
