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
        $alert->week_mon = !!($request->week_mon);
        $alert->week_tue = !!($request->week_tue);
        $alert->week_wed = !!($request->week_wed);
        $alert->week_thu = !!($request->week_thu);
        $alert->week_fri = !!($request->week_fri);
        $alert->week_sat = !!($request->week_sat);
        $alert->week_sun = !!($request->week_sun);

        $type = $request->type;
        if($type=='date'){
            $alert->date_or_type = $request->date;
        } elseif($type=='everyday'){
            $alert->date_or_type = 'everyday';
        } elseif($type=='day_of_week'){
            $alert->date_or_type = 'DayOfWeek';
        };

        $alert->save();

        $mute_dates = null;
        for($i=1;$i<=10;$i++){
            $number = strval(str_pad($i, 2, 0, STR_PAD_LEFT));
            $prop_name = 'mute_date_'.$number;
            $val = $request[$prop_name];
            $val_arr = [
                'mute_date' => $val
            ];
            if(!!$val){
                $mute_dates[] = $val_arr;
            }
        }
        if(!!$mute_dates){
            $alert->mute_dates()->createMany($mute_dates);    
        }
        
        return redirect()->route('alert.index');
    }

    public function showEditForm(int $id){
        $alert = Alert::find($id);

        $date_or_type = $alert->date_or_type; // DBから取得したdate_or_typeの値を得て、$date_or_typeに代入
        $type = null; // $type変数を作っておく
        $date = null; // $dateを作っておく
        
        if($date_or_type=='everyday'){ // $date_or_typeがeveryday->$type='everyday'
            $type='everyday';
        } elseif ($date_or_type=='DayOfWeek') { // $date_or_typeがDayOfWeek->$type='day_of_week'
            $type='day_of_week';
        } else{ // $date_or_typeが日付->$type='date'
            $type='date';
            $date = $date_or_type; // $type=='date'のとき、$date=$date_or_type
        }
        

        return view('alerts/edit',[
            'alert' => $alert,
            'type' => $type, // テンプレートに$typeを渡す
            'date' => $date, // テンプレートに$dateを渡す
        ]);

        // return view('alerts/test',[
        //     'request' => $type,
        // ]);
    }

    public function edit(CreateAlert $request){
        return redirect()->route('alert.index');
    }
}
