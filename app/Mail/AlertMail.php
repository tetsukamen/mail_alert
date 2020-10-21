<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class AlertMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $alert;
    protected $date;
    protected $first_alert_timing;

    public function __construct($alert)
    {
        $this->alert = $alert;
        $this->first_alert_timing = $alert->first_alert_timing->format('G'); // 何時間後の予定かを取得
        $dt = Carbon::now(); // 現在時間を取得
        $dt->addHours(10);
        // 現在時間から何時間後の日付を計算
        // $dateに代入
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('wada.tetsuya11@gmail.com')
            ->subject('テスト送信完了')
            ->view('emails.alert')
            ->with([
                'alert' => $this->alert,
                'first_alert_timing' => $this->first_alert_timing
            ]);
    }
}
