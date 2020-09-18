<?php

namespace App\Http\Controllers;

use App\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\CreateAlert;

class AlertController extends Controller{
    public function index(){
        $alerts = Alert::all();

        return view('alerts/index', [
            'alerts' => $alerts,
        ]);
    }

    public function showCreateForm(){
        return view('alerts/create');
    }

    public function create(CreateAlert $request){
        $alert = new Alert();
        
        $alert->name = $request->name;
        $alert->time = $request->time;
        $alert->email_amount = $request->email_amount;
        $alert->user_id = 1;
        $alert->first_alert_timing = $request->first_alert_timing;
        $alert->second_alert_flag = $request->has('second_alert_flag');
        $alert->second_alert_timing = $request->second_alert_timing;

        $type = $request->type;
        if($type=='date'){
            $alert->date_or_type = $request->date;
        } elseif($type=='everyday'){
            $alert->date_or_type = 'everyday';
        } elseif($type=='day_of_week'){
            $alert->date_or_type = 'DayOfWeek';
        };

        $alert->save();

        // return redirect()->route('alert.index');
        return view('alerts/test', [
            'request' => $request->date,
        ]); 
    }
}
