<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Course;

class CourseController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware(['auth','verified']);
    }

    public function list()
    {
        $course_list=Course::paginate(5);
        return view('course.course_list',compact('course_list'));
    }

    public function add_course_view()
    {
        return view('course.add_course');
    }

    public function add_course(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ], [
            'name.required' => 'Course name is required!',
            'description.required' => 'Course description is required!',
        ]);

        $course = new Course;
        $course->user_id = Auth::user()->id;
        $course->name = $request->name;
        $course->description = $request->description;
        $course->save();

        return redirect()->route('course_list')->with('msg','Course Added successfully');
    }

    public function edit_course_view($id)
    {
        $course_details=Course::where('id',$id)->first();
        // dd($course_details);
        return view('course.edit_course',compact('course_details'));
    }

    public function edit_course(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ], [
            'name.required' => 'Course name is required!',
            'description.required' => 'Course description is required!',
        ]);
        
        $course = Course::where('id', $request->id)->first();
        $course->name = $request->name;
        $course->description = $request->description;
        $course->save();
        return redirect()->route('course_list')->with('msg','Course Update successfully');
    }

    public function delete_course(Request $request)
    {
        $course = Course::where('id', $request->id)->delete();
        return redirect()->back()->with('msg','Course deleted successfully');
    }
}
