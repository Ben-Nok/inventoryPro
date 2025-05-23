<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_alerts', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('product_uuid')->constrained('products', 'uuid');
            $table->integer('alert_at_quantity')->default(0);
            $table->timestamps();
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('product_uuid')->constrained('products', 'uuid');
            $table->uuid('alert_uuid');
            $table->string('type');
            $table->string('message');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_alerts');
        Schema::dropIfExists('notifications');
    }
};
