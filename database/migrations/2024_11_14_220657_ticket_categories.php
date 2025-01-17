<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ticket_categories', function (Blueprint $table) {
            $table->id(); 
            $table->string('type');
            $table->integer('price');
            $table->integer('stock'); // jumlah tiket yang tersisa
            $table->integer('sum_ticket'); // jumlah tiket awal tersedia
            $table->enum('status', ['available', 'sold out']);
            $table->foreignId('event_id')->nullable()->constrained('events')->onDelete('cascade');
            $table->timestamps();
        });           
    }
    public function down(): void
    {
        Schema::dropIfExists('ticket_categories');
    }
};
