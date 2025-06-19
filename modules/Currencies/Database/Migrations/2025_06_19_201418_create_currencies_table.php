<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Currencies currencies migration.
 */

return new class extends Migration
{
    /**
     * Run the Migrations.
     */
    public function up(): void
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->string('symbol');
            $table->decimal('exchange_rate');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
