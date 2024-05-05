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
        Schema::create('timekeeping_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('timekeeping_id')->constrained('timekeepings')->onDelete('cascade');
            $table->integer('working_status')->default(0);
            $table->integer('work_type')->default(0);
            $table->date('date')->nullable();
            $table->decimal('ot', 16, 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timekeeping_details');
    }
};
