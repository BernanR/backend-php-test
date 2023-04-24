<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreprodutosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        dd("hi");
        return [
            'nome' => 'required|string|max:50',
            //'marca' => 'required|string|max:50',
            // 'descricao' => 'required|string|max:255',
            // 'preco' => 'required|float',
            // 'codigo' => 'required|string|max:20|unique(produtos, codigo)',
            // 'qtd_disponivel' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'qtd_disponivel.required' => "A quantidade disponível é obrigatório."
        ];
    }
}
