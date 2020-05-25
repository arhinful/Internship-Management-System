<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

use App\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{

    protected $redirectTo = '/student/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('student.auth:student');
    }

    /**
     * Show the Student dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $student = Auth::guard('student')->user();
        $can_send_report = false;
        $today = Carbon::now()->toDateString();
        $attachment_end = Carbon::make($student->attachment_end)->toDateString();
        if ($today > $attachment_end){
            $can_send_report = true;
        }
        return view('student.home')->with([
            'student' => $student,
            'can_send_report' => $can_send_report
        ]);
    }

    public function profile(){
        $student = Auth::guard('student')->user();
        return view('student.profile')->with('student', $student);
    }

    public function update(Request $request){
        $student = Student::find(Auth::guard('student')->id());

        $this->validate($request, [
            'first_name' => 'required',
            'second_name' => 'required',
            'index_number' => 'required',
            'level' => 'required',
            //'password' => 'required',
        ]);

        $student->first_name = $request->input('first_name');
        $student->second_name = $request->input('second_name');
        $student->other_name = $request->input('other_name');
        $student->level = $request->input('level');
        $student->index_number = $request->input('index_number');

        if ($request->input('email')){
            $this->validate($request, [
                'email' => 'email'
            ]);
            $student->email = $request->input('email');
        }

        //$student->password = $request->input('password');

        if ($student->update()){
            return redirect()->back()->with('success', 'Profile updated successfully');
        }
        else{
            return redirect()->back()->with('error', 'there was an error updating profile, please try again');
        }
    }

    public function submit_report(Request $request){
        $student = Student::find(Auth::guard('student')->id());
        $this->validate($request, [
            'report' => 'required|mimetypes:application/pdf',
        ]);

        $file_name = $student->first_name.'0'.$student->index_number.$request->file('report')->getClientOriginalName();

        if($student->report != null){
            Storage::delete('public/reports/'.$student->report);
            $student->report = null;
        }

        $path = $request->file('report')->storeAs('public/reports', $file_name);

        $student->report = $file_name;
        if ($student->update()){
            return redirect()->back()->with('success', 'Report submitted successfully');
        }
        else{
            return redirect()->back()->with('error', 'There was an error submitting report, please try again');
        }
    }

}