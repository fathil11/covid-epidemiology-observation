<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Provinces
        $sql = file_get_contents(database_path('/seeds/sql/provinces.sql'));
        DB::statement($sql);

        // Regencies
        $sql = file_get_contents(database_path('/seeds/sql/regencies.sql'));
        DB::statement($sql);

        // Districts
        $sql = file_get_contents(database_path('/seeds/sql/districts.sql'));
        DB::statement($sql);

        // Villages
        $sql = file_get_contents(database_path('/seeds/sql/villages.sql'));
        DB::statement($sql);
    }
}
