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
        Schema::create('ticket_categories', function (Blueprint $table) {
            $table->id(); 
            $table->integer('price');
            $table->integer('stock');
            $table->integer('sum_ticket');
            $table->enum('status', ['available', 'sold out']);
            $table->foreignId('event')->nullable()->constrained('events')->onDelete('cascade');
            $table->timestamps();
        });           
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_categories');
    }
};
