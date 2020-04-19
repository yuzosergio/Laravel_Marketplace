<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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

    public function rules()
    {
        //Obriga a preencher os campos abaixo para criar as lojas
        return [
            'name'          => 'required',
            'description'   => 'required|min:10',
            'phone'         => 'required',
            'mobile_phone'  => 'required',
            'logo'          => 'image'

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
