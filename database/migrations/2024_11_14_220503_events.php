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
            $table->dateTime('date');
            $table->text('about');
            $table->string('tagline')->nullable();
            $table->json('keypoint')->nullable();
            $table->string('venue_name');
            $table->enum('status', ['active', 'inactive']);
            $table->foreignId('categories_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->foreignId('image_id')->nullable()->constrained('images')->onDelete('set null');
            $table->foreignId('talent_id')->nullable()->constrained('talents')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });             
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
