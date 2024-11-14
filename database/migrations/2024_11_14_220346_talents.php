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
        Schema::create('talents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->uuid('organizer')->nullable();
            $table->uuid('image')->nullable();
            $table->uuid('role')->nullable();
            $table->foreign('organizer')->references('id')->on('organizers')->onDelete('set null');
            $table->foreign('image')->references('id')->on('images')->onDelete('set null');
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talents');
    }
};
