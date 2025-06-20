<?php

namespace Modules\Currencies\tests\Feature;

use Illuminate\Support\Str;
use Modules\Currencies\Models\Currency;
use Tests\TestCase;

class CurrencyControllerTest extends TestCase
{
    private static string $endpoint = '/api/v1/currencies';

    public function testCurrencyCreation(): void
    {
        $currency = [
            'name' => 'Test Currency',
            'symbol' => '$',
            'exchange_rate' => 60,
        ];

        $response = $this->postJson(self::$endpoint . '', $currency);

        $this->assertEquals($currency['name'], $response->json()['data']['name']);
        $response->assertStatus(201);
    }

    public function testCurrencyCreationUnprocessableContent(): void
    {
        $response = $this->postJson(self::$endpoint . '', []);

        $response->assertStatus(422);
    }

    public function testGetCurrencies(): void
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
        $this->assertEquals(Currency::count(), $json['meta']['total']);
    }

    public function testGetCurrenciesByPage(): void
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

        $this->assertEquals(Currency::count(), $json['meta']['total']);
    }

    public function testShowCurrency(): void
    {
        $currency = Currency::first();

        $response = $this->getJson(self::$endpoint . "/$currency->id");

        $response->assertStatus(200);
        $this->assertEquals($currency->id, $response->json()['data']['id']);
    }

    public function testShowCurrencyNotFound(): void
    {
        $randomUuid = STR::uuid();
        $response = $this->getJson(self::$endpoint . "/$randomUuid");

        $response->assertStatus(404);
    }

    public function testUpdateCurrency(): void
    {
        $currency = Currency::first();
        $currencyEdited = [
            'name' => 'Test Currency edit',
            'symbol' => '$',
            'exchange_rate' => 61,
        ];

        $response = $this->putJson("/api/v1/currencies/{$currency->id}", $currencyEdited);

        $response->assertStatus(200);

        $this->assertDatabaseHas('currencies', [
            'id' => $currency->id,
            'name' => 'Test Currency edit',
        ]);
    }

    public function testUpdateCurrencyNotFound(): void
    {
        $randomUuid = Str::uuid();
        $currencyEdited = [
            'name' => 'Test Currency edit',
            'symbol' => '$',
            'exchange_rate' => 61,
        ];
        $response = $this->putJson(self::$endpoint . "/$randomUuid", $currencyEdited);

        $response->assertStatus(404);
    }

    public function testUpdateCurrencyUnprocessableContent(): void
    {
        $randomUuid = Str::uuid();
        $response = $this->putJson(self::$endpoint . "/$randomUuid", []);

        $response->assertStatus(422);
    }

    public function testDestroyCurrency(): void
    {
        $currency = Currency::first();

        $response = $this->deleteJson(self::$endpoint . "/{$currency->id}");

        $response->assertStatus(204);
    }

    public function testDestroyCurrencyNotFound(): void
    {
        $randomUuid = Str::uuid();
        $response = $this->deleteJson(self::$endpoint . "/$randomUuid");

        $response->assertStatus(404);
    }
}
