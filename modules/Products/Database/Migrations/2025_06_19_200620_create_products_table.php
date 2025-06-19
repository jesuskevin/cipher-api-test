<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Products products migration.
 */

return new class extends Migration
{
    /**
     * Run the Migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->string('description');
            $table->decimal('price');
            $table->foreignUuid('currency_id');
            $table->decimal('tax_cost')->default(0);
            $table->decimal('manufacturing_cost')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
