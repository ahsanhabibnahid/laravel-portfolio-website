<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseModel;

class CourseController extends Controller
{
    function coursesIndex(){
        return view('courses');
    }

    function getCoursesData(){
        $result = json_encode(CourseModel::orderBy('id','desc')->get());
        return $result; 
    }

    function deleteCourses(Request $request){
        $id = $request->input('id');
        $result = CourseModel::where('id','=',$id)->delete();
        if($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }

    function getDetails(Request $request){
        $id = $request->input('id');
        $result = json_decode(CourseModel::where('id','=',$id)->get());
        return $result;
    }

    function updateCourses(Request $request){
        $id = $request->input('id');
        $course_name = $request->input('name');
        $course_des = $request->input('des');
        $course_fee = $request->input('fee');
        $course_totalenroll = $request->input('totalenroll');
        $course_totalclass = $request->input('totalclass');
        $course_link = $request->input('link');
        $course_img = $request->input('img');

        $result = CourseModel::where('id','=',$id)->update([
            'course_name'=>$course_name,
            'course_des'=>$course_des,
            'course_fee'=>$course_fee,
            'course_totalenroll'=>$course_totalenroll,
            'course_totalclass'=>$course_totalclass,
            'course_link'=>$course_link,
            'course_img'=>$course_img,
            ]);
        if($result==true){
            return 1;
        }
        else{
            return 0;
        }
    }

    function addNewCourses(Request $request){
        $course_name = $request->input('name');
        $course_des = $request->input('des');
        $course_fee = $request->input('fee');
        $course_totalenroll = $request->input('totalenroll');
        $course_totalclass = $request->input('totalclass');
        $course_link = $request->input('link');
        $course_img = $request->input('img');
        $result = CourseModel::insert([
            'course_name'=>$course_name,
            'course_des'=>$course_des,
            'course_fee'=>$course_fee,
            'course_totalenroll'=>$course_totalenroll,
            'course_totalclass'=>$course_totalclass,
            'course_link'=>$course_link,
            'course_img'=>$course_img,
            ]);

        if($result==1){
            return 1;
        }
        else{
            return 0;
        }
    }
}
