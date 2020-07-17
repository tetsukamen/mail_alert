<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MuteDatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dt = Carbon::now(); // 今日のdatetimeを取得
        for($i = 0; $i < 3; $i++){
            DB::table('mute_dates')->insert([
                'mute_date' => $dt->toDateString()
            ]);
            $dt->addDay(1);
        }

    }
}
