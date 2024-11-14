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
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->date('date');
            $table->text('about');
            $table->string('tagline')->nullable();
            $table->json('keypoint')->nullable();
            $table->string('venue_name');
            $table->enum('status', ['active', 'inactive']);
            $table->uuid('categories')->nullable();
            $table->uuid('image')->nullable();
            $table->uuid('talent')->nullable();
            $table->uuid('organizer')->nullable();
            $table->foreign('categories')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('image')->references('id')->on('images')->onDelete('set null');
            $table->foreign('talent')->references('id')->on('talents')->onDelete('set null');
            $table->foreign('organizer')->references('id')->on('organizers')->onDelete('set null');
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
