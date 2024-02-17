<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $course_list=Course::where('user_id',Auth::user()->id)->paginate(5);
        // $course_list=Auth::user()->my_list()->paginate(5);  //Using Model Relation
        $total_course = Course::count();
        return view('home',compact('course_list','total_course'));
    }

    public function profile()
    {
        $course_list=Course::where('user_id',Auth::user()->id)->paginate(5);
        $user_details = Auth::user();
        return view('profile',compact('course_list','user_details'));
    }

    public function update_profile(Request $request)
    {
        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:11'],
            'age' => ['required', 'integer', 'max:150'],
            'gender' => ['required', 'string', 'max:11'],
        ]);
        
        $user = User::where('id', Auth::user()->id)->first();
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->mobile = $request->mobile;
        $user->age = $request->age;
        $user->gender = $request->gender;
        $user->save();
        return redirect()->route('profile')->with('msg','Profile Update successfully');
    }

    public function search(Request $request)
    {
        $request->validate([
            'search_key'=>'required',
        ]);
        $key = explode(' ', $request->search_key);
        $search_result = Course::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('name', 'like', "%{$value}%");
            }
        })->paginate(5);

        // $search_result=Course::where('name','LIKE', "%$request->search_key%")->paginate(5);
        return view('search_result',compact('search_result'));
    }
}
