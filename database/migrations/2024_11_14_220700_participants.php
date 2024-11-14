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
        Schema::create('participants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('status')->nullable();
            $table->string('active_code')->nullable();
            $table->timestamps();
        });     

        Schema::create('participant_forgot_password', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code');
            $table->string('status');
            $table->string('active_code')->nullable();
            $table->uuid('participant')->nullable();
            $table->foreign('participant')->references('id')->on('participants')->onDelete('cascade');
            $table->timestamps();
        });        
        
        Schema::create('participant_refresh_token', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('token');
            $table->string('refresh_token');
            $table->uuid('participant')->nullable();
            $table->foreign('participant')->references('id')->on('participants')->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
        Schema::dropIfExists('participant_forgot_password');
        Schema::dropIfExists('participant_refresh_token');
    }
};
