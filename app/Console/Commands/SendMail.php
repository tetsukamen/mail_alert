<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Alert;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertMail;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendmail:alert {alert_id}';

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
        $id = $this->argument("alert_id");
        $alert = Alert::find($id);
        Mail::to('tetsukamen00@gmail.com')
            ->send(new AlertMail($alert));
    }
}
