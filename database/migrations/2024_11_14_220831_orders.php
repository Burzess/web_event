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
            $table->uuid('id')->primary();
            $table->date('date');
            $table->string('status');
            $table->integer('total_pay');
            $table->integer('total_order_ticket');
            $table->uuid('participant')->nullable();
            $table->uuid('event')->nullable();
            $table->json('personalDetail')->nullable();
            $table->foreign('participant')->references('id')->on('participants')->onDelete('set null');
            $table->foreign('event')->references('id')->on('events')->onDelete('set null');
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
