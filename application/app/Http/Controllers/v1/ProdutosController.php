<?php

namespace App\Http\Controllers\v1;

use Exception;
use App\Models\Produtos;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProdutosResource;
use App\Http\Requests\StoreprodutosRequest;
use App\Http\Requests\UpdateprodutosRequest;

class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Produtos = Produtos::paginate(Produtos::PRODUTOS_POR_PAGE);
        return ProdutosResource::collection($Produtos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreprodutosRequest $request)
    {
        $Produto = Produtos::created($request->validated());
        return ProdutosResource::make($Produto);
    }

    /**
     * Display the specified resource.
     */
    public function show(Produtos $produto)
    {
        return ProdutosResource::make($produto);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateprodutosRequest $request, produtos $produtos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produtos $produto)
    {
        try {
            $produto->delete();
            return response()->json(['message' => 'Produto excluido com sucesso!'], 200);

        } catch (Exception $e) {

            // Handle the exception
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
