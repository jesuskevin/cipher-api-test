<?php

namespace Modules\Products\tests\Feature;

use Illuminate\Support\Str;
use Modules\Currencies\Models\Currency;
use Modules\Products\Models\Product;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    private static string $endpoint = '/api/v1/products';

    public function testProductCreation(): void
    {
        $product = [
            'name' => 'Test Product',
            'description' => 'Product Description',
            'price' => 10,
            'currency_id' => Currency::factory()->create()->id,
            'tax_cost' => 4.99,
            'manufacturing_cost' => 4.99,
        ];

        $response = $this->postJson(self::$endpoint . '', $product);

        $this->assertEquals($product['name'], $response->json()['data']['name']);
        $response->assertStatus(201);
    }

    public function testProductCreationUnprocessableContent(): void
    {
        $response = $this->postJson(self::$endpoint . '', []);

        $response->assertStatus(422);
    }

    public function testGetProducts(): void
    {
        $response = $this->getJson(self::$endpoint . '');
        $json = $response->json();

        $response->assertStatus(200);
        $this->assertEquals(1, $json['meta']['current_page']);
        $this->assertEquals(10, $json['meta']['per_page']);
        $response->assertJsonStructure([
            'data',
            'links' => [
                'first',
                'last',
                'prev',
                'next',
            ],
            'meta' => [
                'current_page',
                'per_page',
                'total',
                'last_page',
                'links',
                'path',
                'per_page',
                'to',
                'total',
            ],
        ]);
        $this->assertEquals(Product::count(), $json['meta']['total']);
    }

    public function testGetProductsByPage(): void
    {
        $response = $this->getJson(self::$endpoint . '?page=1');

        $json = $response->json();

        $response->assertStatus(200);
        $this->assertEquals(1, $json['meta']['current_page']);
        $this->assertEquals(10, $json['meta']['per_page']);
        $response->assertJsonStructure([
            'data',
            'links' => [
                'first',
                'last',
                'prev',
                'next',
            ],
            'meta' => [
                'current_page',
                'per_page',
                'total',
                'last_page',
                'links',
                'path',
                'per_page',
                'to',
                'total',
            ],
        ]);

        $this->assertEquals(Product::count(), $json['meta']['total']);
    }

    public function testShowProduct(): void
    {
        $product = Product::first();

        $response = $this->getJson(self::$endpoint . "/{$product->id}");

        $response->assertStatus(200);
        $this->assertEquals($product->id, $response->json()['data']['id']);
    }

    public function testShowProductNotFound(): void
    {
        $randomUuid = STR::uuid();
        $response = $this->getJson(self::$endpoint . "/$randomUuid");

        $response->assertStatus(404);
    }

    public function testUpdateProduct(): void
    {
        $product = Product::first();
        $productEdited = [
            'name' => 'Test Product edit',
            'description' => 'Product Description',
            'price' => 10,
            'currency_id' => Currency::factory()->create()->id,
            'tax_cost' => 4.99,
            'manufacturing_cost' => 4.99,
        ];

        $response = $this->putJson(self::$endpoint . "/{$product->id}", $productEdited);

        $response->assertStatus(200);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Test Product edit',
        ]);
    }

    public function testUpdateProductNotFound(): void
    {
        $randomUuid = Str::uuid();
        $productEdited = [
            'name' => 'Test Product edit',
            'description' => 'Product Description',
            'price' => 10,
            'currency_id' => Currency::factory()->create()->id,
            'tax_cost' => 4.99,
            'manufacturing_cost' => 4.99,
        ];
        $response = $this->putJson(self::$endpoint . "/$randomUuid", $productEdited);

        $response->assertStatus(404);
    }

    public function testUpdateProductUnprocessableContent(): void
    {
        $randomUuid = Str::uuid();
        $response = $this->putJson(self::$endpoint . "/$randomUuid", ['name' => 1, 'type' => 'tests']);

        $response->assertStatus(422);
    }

    public function testDestroyProduct(): void
    {
        $product = Product::first();

        $response = $this->deleteJson(self::$endpoint . "/{$product->id}");

        $response->assertStatus(204);
    }

    public function testDestroyProductNotFound(): void
    {
        $randomUuid = Str::uuid();
        $response = $this->deleteJson(self::$endpoint . "/$randomUuid");

        $response->assertStatus(404);
    }

    public function testGetProductPrices(): void
    {
        $product = Product::with('prices')->first();
        $response = $this->getJson(self::$endpoint . "/$product->id/prices");
        $json = $response->json();

        $response->assertStatus(200);
        $this->assertEquals(1, $json['meta']['current_page']);
        $this->assertEquals(10, $json['meta']['per_page']);
        $response->assertJsonStructure([
            'data',
            'links' => [
                'first',
                'last',
                'prev',
                'next',
            ],
            'meta' => [
                'current_page',
                'per_page',
                'total',
                'last_page',
                'links',
                'path',
                'per_page',
                'to',
                'total',
            ],
        ]);
        $this->assertEquals($product->prices->count(), $json['meta']['total']);
    }

    public function testGetProductPricesNotFound(): void
    {
        $randomUuid = Str::uuid();
        $response = $this->getJson(self::$endpoint . "/$randomUuid/prices");

        $response->assertStatus(404);
    }

    public function testStoreProductPrices(): void
    {
        $product = Product::first();
        $productPrice = [
            'currency_id' => Currency::factory()->create()->id,
            'price' => 25.50,
        ];

        $response = $this->postJson(self::$endpoint . "/$product->id/prices", $productPrice);

        $this->assertEquals($productPrice['currency_id'], $response->json()['data']['currency']['id']);
        $response->assertStatus(201);
    }

    public function testStoreProductPricesNotFound(): void
    {
        $productPrice = [
            'currency_id' => Currency::factory()->create()->id,
            'price' => 25.50,
        ];
        $randomUuid = Str::uuid();
        $response = $this->postJson(self::$endpoint . "/$randomUuid/prices", $productPrice);

        $response->assertStatus(404);
    }
}
