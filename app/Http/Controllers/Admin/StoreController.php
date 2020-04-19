<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreRequest;
use App\Traits\UploadTrait;

class StoreController extends Controller
{
    use UploadTrait;
    //aplicando o metodo para ver o create e store do UserHasStoreMiddleware
    public function __construct(){
        //$this->middleware('user.has.store')->only(['create', 'store']);
    }

    public function index(){

        $store = auth()->user()->store;
        return view('admin.stores.index', compact('store'));
    }

    public function create(){
        
        //pode passar na array apenas os campos que quero pegar
        $users = \App\User::all(['id','name']);
        return view('admin.stores.create',compact('users'));
    }

    public function store(StoreRequest $request){
        //recebeu os dados
        $data = $request->all();
        
        $user = auth()->user();

        if($request->hasFile('logo')){
            $data['logo'] = $this->imageUpload($request->file('logo'));
        }
        
        //criou a loja com base na ligação 1 para 1
        $store = $user->store()->create($data);

        flash('Loja criada com sucesso')->success(); 
        return redirect()->route('admin.stores.index');
    }

    public function edit($store){
        $store = \App\Store::find($store);

        return view('admin.stores.edit', compact('store'));
    }

    public function update(StoreRequest $request, $store){
        $data = $request->all();
        $store = \App\Store::find($store);

        if($request->hasFile('logo')){
            if(Storage::disk('public')->exists($store->logo)){
                Storage::disk('public')->delete($store->logo);
            }
            $data['logo'] = $this->imageUpload($request->file('logo'));
        }

        $store->update($data);

        flash('Loja Atualizada com sucesso')->success();
        return redirect()->route('admin.stores.index');
    }

    public function destroy($store){
        $store = \App\Store::find($store);
        $store->delete();
        
        flash('Loja Removida com sucesso')->warning(); 
        return redirect()->route('admin.stores.index');
    }
}
