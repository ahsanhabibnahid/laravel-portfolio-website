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
        $result = json_decode(ServiceModel::orderBy('id','desc')->get());
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

    function getDetails(Request $request){
        $id = $request->input('id');
        $result = json_decode(ServiceModel::where('id','=',$id)->get());
        return $result;
    }

    function updateService(Request $request){
        $id = $request->input('id');
        $name = $request->input('name');
        $des = $request->input('des');
        $img = $request->input('img');
        $result = ServiceModel::where('id','=',$id)->update(['service_name'=>$name,'service_des'=>$des,'service_img'=>$img]);
        if($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }

    function addNewService(Request $request){
        $name = $request->input('name');
        $des = $request->input('des');
        $img = $request->input('img');
        $result = ServiceModel::insert(['service_name'=>$name,'service_des'=>$des,'service_img'=>$img]);

        if($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }
}
