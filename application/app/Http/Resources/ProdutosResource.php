<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdutosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome'  => $this->nome,
            'descricao'  => $this->descricao,
            'marca'  => $this->marca,
            'preco'  => $this->preco,
            'codigo' => $this->codigo,
            "qtd_disponivel" => $this->qtd_disponivel
        ];
    }
}
