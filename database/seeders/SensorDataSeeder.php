<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;   // ← ini yang kurang
use Carbon\Carbon;

class SensorDataSeeder extends Seeder
{
    public function run()
    {
        $file = database_path('seeders/dummy_scada_data.csv');
        if (!file_exists($file)) return;

        $handle = fopen($file, 'r');
        $header = fgetcsv($handle); // skip header
        while ($row = fgetcsv($handle)) {
            DB::table('sensor_data')->insert([
                'timestamp' => $row[0],
                'voltage_V' => $row[1],
                'current_A' => $row[2],
                'power_W'   => $row[3],
                'energy_kWh'=> $row[4],
                'frequency_Hz' => $row[5],
                'power_factor' => $row[6],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        fclose($handle);
    }
}