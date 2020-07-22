<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectModel;
 
class ProjectController extends Controller
{
    function projectIndex(){
        return view('project');
    }

    function getProjectData(){
        $result = json_encode(ProjectModel::orderBy('id','desc')->get());
        return $result;
    }

    function addNewProject(Request $request){
        $name =  $request->input('name');
        $des =  $request->input('des');
        $link =  $request->input('link');
        $img =  $request->input('img');

        $result = ProjectModel::insert(['project_name'=>$name,'project_desc'=>$des,'project_link'=>$link,'project_img'=>$img]);
        if($result==true){
            return 1;
        }
        else {
            return 0;
        }
    }

    function deleteProject(Request $request){
        $id = $request->input('id');
        $result = ProjectModel::where('id','=',$id)->delete();

        if($result==true){
            return 1;
        }
        else {
            return 0;
        }

    }

    function getProjectForUpdate(Request $request){
        $id = $request->input('id');
        $result = json_decode(ProjectModel::where('id','=',$id)->get());

        return $result;
    }

    function updateProject(Request $request){
        $id = $request->input('id');
        $name = $request->input('name');
        $des = $request->input('des');
        $link = $request->input('link');
        $img = $request->input('img');

        $result = ProjectModel::where('id','=',$id)->update(["project_name"=>$name,'project_desc'=>$des,'project_link'=>$link,'project_img'=>$img]);

        if($result==true){
            return 1;
        }
        else {
            return 0;
        }
    }



}
