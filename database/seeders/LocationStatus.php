<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('locationstatus')->insert([
            'id' => 50000,
            'location_status' => 'พร้อมใช้',

        ]);
        DB::unprepared("UPDATE locationstatus SET id=0");

        DB::table('locationstatus')->insert([
            'id' => 1,
            'location_status' => 'ไม่พร้อมใช้',

        ]);





    }
}
