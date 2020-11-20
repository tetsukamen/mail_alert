<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Alert;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertMail;
use Carbon\Carbon;
use App\User;

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

    protected $dayOfWeekDict = [ // idxと曜日の対応づけ
        0 => 'week_sun',
        1 => 'week_mon',
        2 => 'week_tue',
        3 => 'week_wed',
        4 => 'week_thu',
        5 => 'week_fri',
        6 => 'week_sat',
    ];

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
        $alerts = Alert::all(); // すべてのアラートを取得する
        foreach($alerts as $alert){ // 各アラートについて送信時間を計算し、今送るものならば送信する
            $mute_dates = $alert->mute_dates()->get();
            foreach($mute_dates as $mute_date){
                $mute_date_instance = Carbon::parse($mute_date->mute_date);
                
                logger()->info($mute_date_instance);
            }
            // $this->sendAlertMail($alert,$alert->first_alert_timing);
            // if(!!$alert->second_alert_flag){ // second_alert_timingが存在すれば実行する
            //     $this->sendAlertMail($alert,$alert->second_alert_timing);
            // }
        }
    }

    public function sendAlertMail($alert,$alert_timing){
        // first_alert_timingの取得
        $alert_timing = Carbon::parse($alert_timing);
        // 現在時間を取得
        $dt = Carbon::now('Asia/Tokyo');
        // $dtをfirst_alert_timingの時間分だけ進める
        $dt->addHours($alert_timing->hour);
        $dt->addMinutes($alert_timing->minute);

        $scheduled_date = $alert->date_or_type; // アラート日付の取得
        // date_or_typeによって場合わけする
        if($scheduled_date=='everyday'){
            $send_date_dt=$dt->copy();
            $send_time_dt = Carbon::parse($alert->time); // アラート時間の取得
            $send_date_dt->hour = $send_time_dt->hour;
            $send_date_dt->minute = $send_time_dt->minute; // $dtと同じ日付で$alertの時間
            $send_date_dt_15before = $send_date_dt->copy();
            $send_date_dt_15before->subMinutes(15);
            // $dtが予定時間から15分後までの間かどうかを判定　条件：$send_date_dt_15before<$dt<=$send_date_dt
            if($send_date_dt_15before < $dt && $dt <= $send_date_dt){
                // 条件を満たしていればメールを送信する
                for($i=0;$i<$alert->email_amount;$i++){
                    Mail::to(User::find($alert->user_id)->email)->send(new AlertMail($alert,$alert_timing));
                }
            }
        }elseif($scheduled_date=='DayOfWeek'){ // 曜日の場合
            $send_date_dt=$dt->copy();
            $send_time_dt = Carbon::parse($alert->time); // アラート時間の取得
            $send_date_dt->hour = $send_time_dt->hour;
            $send_date_dt->minute = $send_time_dt->minute; // $dtと同じ日付で$alertの時間
            $send_date_dt_15before = $send_date_dt->copy();
            $send_date_dt_15before->subMinutes(15);
            // 曜日のチェック
            $dayOfWeekIdx = $send_date_dt->dayOfWeek; // $send_date_dtの曜日を取得する
            $weekName = $this->dayOfWeekDict[$dayOfWeekIdx]; // 曜日のstring取得
            // $dtが予定時間から15分後までの間かどうかを判定　条件：$send_date_dt_15before<$dt<=$send_date_dtかつ曜日条件を満たしている
            if($send_date_dt_15before < $dt && $dt <= $send_date_dt && $alert[$weekName]){
                // 条件を満たしていればメールを送信する
                for($i=0;$i<$alert->email_amount;$i++){
                    Mail::to(User::find($alert->user_id)->email)->send(new AlertMail($alert,$alert_timing));
                }
            }
        }else{ // 日付の場合
            $send_date_dt = Carbon::create($scheduled_date, 'Asia/Tokyo'); // アラート日付の取得
            $send_time_dt = Carbon::parse($alert->time); // アラート時間の取得
            // アラート日時の設定
            $send_date_dt->hour = $send_time_dt->hour;
            $send_date_dt->minute = $send_time_dt->minute; // アラートを設定した時間が格納されている
            // アラート日時の１５分前のdt
            $send_date_dt_15before = $send_date_dt->copy();
            $send_date_dt_15before->subMinutes(15);
            // $dtが予定時間から15分後までの間かどうかを判定　条件：$send_date_dt_15before<$dt<=$send_date_dt
            if($send_date_dt_15before < $dt && $dt <= $send_date_dt){
                // 条件を満たしていればメールを送信する
                for($i=0;$i<$alert->email_amount;$i++){
                    Mail::to(User::find($alert->user_id)->email)->send(new AlertMail($alert,$alert_timing));
                }
            }
        }
        // logger()->info();
    }
}
