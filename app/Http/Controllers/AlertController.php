<?php

namespace App\Http\Controllers;

use App\Alert;
use Illuminate\Http\Request;

class AlertController extends Controller{
    public function index(){
        $alerts = Alert::all();

        return view('alerts/index', [
            'alerts' => $alerts,
        ]);
    }
}
