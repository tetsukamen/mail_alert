<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Alert;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertMail;
use Carbon\Carbon;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendmail:alert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send alert mail';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $dt = Carbon::now(); // 現在時間を取得
        $alerts = Alert::all(); // すべてのアラートを取得する
        foreach($alerts as $alert){ // 各アラートについて送信時間を計算し、今送るものならば送信する
            // 1回目のメールを送る時間を計算する
            // アラート日付の取得
            $scheduled_date = $alert->date_or_type;
            if($scheduled_date=='everyday'){

            }elseif($scheduled_date=='DayOfWeek'){

            }else{ // 日付の場合
                $send_date_dt = Carbon::create($scheduled_date);
            }
            // アラート時間の取得
            // $send_time_dt = Carbon::create($alert->time);
            // アラート日時の設定
            // $send_date_dt->hour = $send_date_dt->hour;
            // $send_date_dt->minute = $send_date_dt->minute;
            // // first_alert_timingの首藤
            // $first_alert_timing = Carbon::create($alert->first_alert_timing);
            // // first_alert_timingの時間分だけ時間を巻き戻す
            // $send_date_dt->subHours($first_alert_timing->hour);
            // $send_date_dt->subMinutes($first_alert_timing->minute);

            logger()->info($send_date_dt);
            // 現在時間と比較し、送るべきなら送信する
            // Mail::to('tetsukamen00@gmail.com')
            // ->send(new AlertMail($alert));
        }
    }
}
