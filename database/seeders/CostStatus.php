<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CostStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('coststatus')->insert([
            'id' => 50000,
            'coststatus_name' => 'รออนุมัติ',

        ]);
        DB::unprepared("UPDATE coststatus SET id=0");

        DB::table('coststatus')->insert([
            'id' => 1,
            'coststatus_name' => 'อนุมัติเรียบร้อย',

        ]);

        DB::table('coststatus')->insert([
            'id' => 2,
            'coststatus_name' => 'ไม่อนุมัติ',

        ]);
    }
}
