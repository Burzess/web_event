<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id(); 
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('status')->nullable();
            $table->string('active_code')->nullable();
            $table->timestamps();
        });
        
        Schema::create('participant_forgot_passwords', function (Blueprint $table) {
            $table->id(); 
            $table->string('code');
            $table->string('status');
            $table->string('active_code')->nullable();
            $table->foreignId('participant_id')->nullable()->constrained('participants')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('participant_forgot_passwords');
        Schema::dropIfExists('participants');
    }
};
