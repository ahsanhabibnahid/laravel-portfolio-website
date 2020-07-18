<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VisitorModel;
use App\ServicesModel;

class HomeController extends Controller
{
    public function HomeIndex(){
        $UserIP = $_SERVER['REMOTE_ADDR'];
        date_default_timezone_set('Asia/Dhaka');
        $timeDate= date("Y-m-d h:i:sa");
        VisitorModel::insert(['ip_address'=>$UserIP,'visit_time'=>$timeDate]);

        $servicesData = json_decode(ServicesModel::orderBy('id','desc')->limit(4)->get());

        return view('home',['servicesKey'=>$servicesData]);
    }
}
