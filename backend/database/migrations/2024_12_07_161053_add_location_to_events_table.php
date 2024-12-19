<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->decimal('latitude', 10, 8)->nullable()->after('venue_name'); // Koordinat latitude
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');  // Koordinat longitude
            $table->string('address')->nullable()->after('longitude');          // Alamat lengkap
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude', 'address']);
        });
    }

};
