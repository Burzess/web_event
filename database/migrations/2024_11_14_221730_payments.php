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
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->boolean('status');
            $table->uuid('image')->nullable();
            $table->uuid('organizer')->nullable();
            $table->foreign('image')->references('id')->on('images')->onDelete('set null');
            $table->foreign('organizer')->references('id')->on('organizers')->onDelete('set null');
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
