<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductPhotoController extends Controller
{
    public function removePhoto(Request $request){
        $photoName = $request->get('photoName');
        //Remover dos arquivos
        if(Storage::disk('public')->exists($photoName)){
            Storage::disk('public')->delete($photoName);
        }
        //remover do banco
        $removePhoto = ProductPhoto::where('image', $photoName);
        //ao clicar em remover redireciona para a mesma pagina e retorna mensagem de sucesso
        $productId = $removePhoto->first()->product_id;

        $removePhoto->delete();

        flash('Imagem removida com sucesso!')->success();
        return redirect()->route('admin.products.edit', ['product' => $productId]);
    }
}
