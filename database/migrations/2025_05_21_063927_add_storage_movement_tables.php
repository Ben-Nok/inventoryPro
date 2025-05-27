<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('storage_uuid')->constrained('storages', 'uuid')->onDelete('cascade');
            $table->foreignUuid('product_uuid')->constrained('products', 'uuid')->onDelete('cascade');
            $table->integer('quantity');
            $table->timestamps();
        });

        Schema::create('storage_movements', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('storage_uuid')->constrained('storages', 'uuid')->onDelete('cascade');
            $table->foreignUuid('product_uuid')->constrained('products', 'uuid')->onDelete('cascade');
            $table->enum('movement', ['in', 'out']);
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
        Schema::dropIfExists('storage_movements');
    }
};
