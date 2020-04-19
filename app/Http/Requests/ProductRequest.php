<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required',
            'description'   => 'required|min:10',
            'body'          => 'required',
            'price'         => 'required',
            //coloca se asterisco na frente quando for dizer que vai pegar todas as imagens de um array que foi declarado em um view
            'photos.*'        => 'image',
        ];
        
    }
    public function messages(){
        return[
            'min' => 'Campo deve ter no minimo :min caracteres',
            'required' => 'Este campo é obrigatório',
            'image' => 'Arquivo não é uma imagem valida'
        ];
    }
}
