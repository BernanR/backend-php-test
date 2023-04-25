<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Produtos;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    //use RefreshDatabase;
    CONST API_VERSION = "/api/v1";
    PRIVATE $PRODUCT_CODE;

    public function test_it_should_test_the_structure_of_the_product_list_response(): void
    {
        $response = $this->get(SELF::API_VERSION . "/products");
        $response->assertOk();
        $response->assertJsonCount(Produtos::PRODUCTS_PER_PAGE, "data");

        $response->assertJsonStructure([
            'data' => [
                "*" => [
                    'id',
                    'nome',
                    'descricao',
                    'marca',
                    'preco',
                    'codigo',
                    'qtd_disponivel'
                ]
            ]
        ]);
    }

    public function test_it_should_test_the_storage_product_method(): void
    {
        $this->PRODUCT_CODE = 'PROD' . fake()->ean13();

        $product = [
            "nome" => "Mug",
            "marca" => "Microsoft",
            "descricao" => "Blue with little blue dots",
            "qtd_disponivel" => 20,
            "preco" => "10.20",
            "codigo" => $this->PRODUCT_CODE
        ];

        $response = $this->post(SELF::API_VERSION . '/products', $product);
        $response->assertJsonCount(7, "data");
        $response->assertStatus(201);

        $this->assertDatabaseHas('produtos', $product);
    }

    public function test_it_should_test_if_unique_product_code_is_validating(): void
    {
        $product = [
            "nome" => "Mug",
            "marca" => "Microsoft",
            "descricao" => "Blue with little blue dots",
            "qtd_disponivel" => 20,
            "preco" => "10.20",
            "codigo" => $this->PRODUCT_CODE
        ];

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])
        ->post(SELF::API_VERSION . '/products', $product);

        $response->assertJsonCount(2);
        $response->assertStatus(422);

        $response->assertJsonStructure([
            "message",
            "errors" => ["codigo"]
        ]);

        $this->assertDatabaseMissing('produtos', $product);
    }

    public function test_it_should_test_the_update_product_method()
    {
        $product = Produtos::factory()->create();

        $updatedProductData = [
            "nome" => "Mug updated",
            "marca" => "Android",
            "descricao" => "White with little purple dots",
            "preco" => "110.25",
            "codigo" => 'PROD' . fake()->ean13(),
            "qtd_disponivel" => 20
        ];

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])
        ->put(SELF::API_VERSION . '/products/' . $product->id, $updatedProductData);

        $updatedProductData = array_merge(['id' => $product->id], $updatedProductData);
        $response->assertStatus(200);
        $this->assertEquals($updatedProductData, $response->json("data"));
    }

    public function test_it_should_test_the_delete_product_method()
    {
        $product = Produtos::factory()->create();

        $response = $this->delete(SELF::API_VERSION . '/products/' . $product->id);
        $response->assertStatus(200);

        $this->assertDatabaseMissing('produtos', ['id' => $product->id]);
    }

    public function test_it_should_test_the_removing_mask_product_method(): void
    {
        $product = [
            "nome" => "Mug",
            "marca" => "Microsoft",
            "descricao" => "Blue with little blue dots",
            "qtd_disponivel" => 20,
            "preco" => "R$ 1.000,20",
            "codigo" => 'PROD' . fake()->ean13()
        ];

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])
        ->post(SELF::API_VERSION . '/products', $product);

        $response->assertJsonCount(7, "data");
        $response->assertStatus(201);
        $this->assertDatabaseHas('produtos', ["codigo" => $product["codigo"]]);
    }

    public function test_it_should_test_the_storage_product_method_error(): void
    {
        $product = [
            "nome" => "Mug",
            "marca" => "Microsoft",
            "descricao" => "Blue with little blue dots",
            "qtd_disponivel" => 20,
            "preco" => "R$ 145445545454b.454544.000,20",
            "codigo" => 'PROD' . fake()->ean13()
        ];

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])
        ->post(SELF::API_VERSION . '/products', $product);

        $response->assertStatus(422);
    }

    public function test_it_should_test_missing_product_delete_method()
    {
        $response = $this->delete(SELF::API_VERSION . '/products/' . 0);
        $response->assertStatus(204);
    }
}
