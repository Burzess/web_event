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
            $table->id(); 
            $table->string('title');
            $table->date('date');
            $table->text('about');
            $table->string('tagline')->nullable();
            $table->json('keypoint')->nullable();
            $table->string('venue_name');
            $table->enum('status', ['active', 'inactive']);
            $table->foreignId('categories')->nullable()->constrained('categories')->onDelete('set null');
            $table->foreignId('image')->nullable()->constrained('images')->onDelete('set null');
            $table->foreignId('talent')->nullable()->constrained('talents')->onDelete('set null');
            $table->foreignId('organizer')->nullable()->constrained('organizers')->onDelete('set null');
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
