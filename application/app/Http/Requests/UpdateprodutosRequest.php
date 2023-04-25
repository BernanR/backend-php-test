<?php

namespace App\Http\Requests;

use App\Helpers\MaskHelper;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateprodutosRequest extends FormRequest
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
        $product = $this->route('product');
        $storeProductsRule = (new StoreprodutosRequest())->rules();
        $storeProductsRule['codigo'] = Rule::unique('produtos')->ignore($product->id);
        return $storeProductsRule;
    }

    public function prepareForValidation()
    {
         //REMOVE MASCARA SE HOVER
        $preco = MaskHelper::removeMoneyMask($this->preco);

        $this->merge([
            'preco' => trim($preco),
        ]);
    }
}
