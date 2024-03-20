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
        Schema::create('products_dispatch_note', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dispatch_note_id')->constrained('dispatch_notes')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('quantity')->nullable();
            $table->decimal('current_purchase_price', 16, 4)->nullable();
            $table->decimal('current_price', 16, 4)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_dispatch_note');
    }
};
