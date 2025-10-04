<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sensor_data', function (Blueprint $table) {
            $table->id();
            $table->timestamp('timestamp')->index();
            $table->decimal('voltage_V', 8, 2);
            $table->decimal('current_A', 8, 3);
            $table->decimal('power_W', 10, 2);
            $table->decimal('energy_kWh', 12, 4);
            $table->decimal('frequency_Hz', 6, 2)->nullable();
            $table->decimal('power_factor', 5, 2)->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_data');
    }
};
