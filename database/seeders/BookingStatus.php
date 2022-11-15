<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('bookingstatus')->insert([
            'id' => 50000,
            'bookingstatus_name' => 'รออนุมัติ',

        ]);
        DB::unprepared("UPDATE bookingstatus SET id=0");

        DB::table('bookingstatus')->insert([
            'id' => 1,
            'bookingstatus_name' => 'อนุมัติเรียบร้อย',

        ]);

        DB::table('bookingstatus')->insert([
            'id' => 2,
            'bookingstatus_name' => 'ไม่อนุมัติ',

        ]);

        DB::table('bookingstatus')->insert([
            'id' => 10,
            'bookingstatus_name' => 'ขอยกเลิกการจอง',

        ]);

      

    }
}
