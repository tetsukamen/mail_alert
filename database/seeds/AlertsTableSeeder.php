<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AlertsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['買い物', '体操教室', 'プログラミング', '夕食'];
        $dt = Carbon::now();

        foreach ($names as $name) {
            DB::table('alerts')->insert([
                'name' => $name,
                'date' => $dt->toDateString(),
                'time' => $dt->format('h:i'),
                'email_amount' => 2,
                'user_id' => 1,
                'first_alert_timing' => $dt->format('h:i'),
                'second_alert_flag' => true,
                'second_alert_timing' => $dt->format('h:i')
            ]);
        }
    }
}
