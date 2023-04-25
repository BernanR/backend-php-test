<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    use HasFactory;

    CONST PRODUCTS_PER_PAGE = 20;

    protected $fillable = [
        'nome',
        'descricao',
        'marca',
        'preco',
        'qtd_disponivel',
        'codigo',
    ];
}
