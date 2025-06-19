<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * ProductPrices productprices migration.
 */

return new class extends Migration
{
    /**
     * Run the Migrations.
     */
    public function up(): void
    {
        Schema::create('product_prices', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignUuid('product_id');
            $table->foreignUuid('currency_id');
            $table->decimal('price');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_prices');
    }
};
