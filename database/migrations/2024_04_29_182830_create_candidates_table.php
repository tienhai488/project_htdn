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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recruitment_id')->constrained('recruitments')->onDelete('cascade');
            $table->string('name', 100)->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->integer('gender')->default(0);
            $table->timestamp('birthday')->nullable();
            $table->decimal('desired_salary', 16, 4)->nullable();
            $table->integer('status')->default(0);
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
