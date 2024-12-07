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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); 
            $table->date('date');
            $table->string('status');
            $table->integer('total_pay');
            $table->integer('total_order_ticket');
            $table->foreignId('participant_id')->nullable()->constrained('participants')->onDelete('set null');
            $table->foreignId('event_id')->nullable()->constrained('events')->onDelete('set null');
            $table->json('personalDetail')->nullable();
            $table->timestamps();
        });             
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
