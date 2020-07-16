<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceModel;

class ServicesController extends Controller
{
    function servicesIndex(){
        return view('services');
    }

    function getServicesData(){
        $result = json_encode(ServiceModel::all());
        return $result; 
    }

    function deleteServices(Request $request){
        $id = $request->input('id');
        $result = ServiceModel::where('id','=',$id)->delete();
        if($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }
}
