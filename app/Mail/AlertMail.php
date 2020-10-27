<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AlertMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $alert;
    protected $start_date;

    public function __construct($alert)
    {
        $this->alert = $alert;
        $first_alert_timing = $alert->first_alert_timing;

        // 現在時間から何時間後の日付を計算
        $dt = Carbon::now(); // 現在時間を取得
        $add_hour = $first_alert_timing->format('G');
        $add_minute = $first_alert_timing->format('i');
        $dt->addHours($add_hour);
        $dt->addMinutes($add_minute);
        $this->start_date = $dt->format('Y年m月d日');
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
            ->subject($this->alert->name)
            ->view('emails.alert')
            ->with([
                'alert' => $this->alert,
                'start_date' => $this->start_date,
            ]);
    }
}
