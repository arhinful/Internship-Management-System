<?php

namespace App\Http\Controllers\Company;

use App\Activity;
use App\Company;
use App\Http\Controllers\Controller;
use App\Setting;
use App\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class HomeController extends Controller
{

    protected $redirectTo = '/company/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('company.auth:company');
    }

    /**
     * Show the Company dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $company = Auth::guard('company')->user();
        return view('company.home')->with('company', $company);
    }

    public function all_enrolled_student(){
        $company = Auth::guard('company')->user();

        $today = Carbon::today()->toDateString();
        $raw_students = $company->students->all();
        $students = array();

        foreach ($raw_students as $raw_student){
            $attachment_end = Carbon::make($raw_student->attachment_end)->addDays(30)->toDateString();
            if ($today < $attachment_end){
                $students[] = $raw_student;
            }
        }

        //return $students;

        foreach ($students as $student){

            $student->act_taken = false;
            $student->activity_done='';
            $student->activity_id = null;

            foreach ($student->activities as $act){
                $act_date = Carbon::parse($act->created_at);
                $act_date = $act_date->toDateString();

                if ($act_date == $today){
                    $student->act_taken = true;
                    $student->activity_id = $act->id;
                    $student->activity_done = $act->act_assigned;
                }
            }
        }

        return view('company.all_enrolled_student')->with([
            'students' => $students,
            'company' => $company
        ]);
    }

    public function enroll_new_student(){
        $students = Student::where('company_id', null)->get();
        $company = Auth::guard('company')->user();
        return view('company.enroll_new_student')->with([
            'students' => $students,
            'company' => $company
        ]);
    }

    public function profile(){
        $company = Auth::guard('company')->user();
        return view('company.profile')->with('company', $company);
    }

    public function enroll_student(Request $request){
        $student_id = $request->input('student_id');

        $student = Student::findOrFail($student_id);

        $attachment_start = Carbon::now()->toDateTimeString();
        $attachment_period = Setting::findOrFail(1)->attachment_period;
        $attachment_end = Carbon::now()->addDays($attachment_period)->toDateTimeString();

        $student->attachment_company = $request->input('attachment_company_name');
        $student->company_id = $request->input('attachment_company_id');
        $student->attachment_start = $attachment_start;
        $student->attachment_end = $attachment_end;
        if ($student->update()){
            return redirect()->back()->with('success', 'Student Enrolled successfully');
        }
        else{
            return redirect()->back()->with('error', 'There was an error Enrolling student, please try again');
        }

    }

    public function student_details($id){
        $student = Student::findOrFail($id);
        $today = Carbon::now()->toDateString();
        $canGiveScore = false;
        $is_current = true;
        $is_current_end = Carbon::make($student->attachment_end)->addDays(30)->toDateString();
        if ($today > $is_current_end){
            $is_current = false;
        }

        $attachment_end = Carbon::make($student->attachment_end);
        if ($today > $attachment_end){
            $canGiveScore = true;
        }
        return view('company.student_details')->with([
            'student'=>$student,
            'cgs'=>$canGiveScore,
            'is_current' => $is_current,
        ]);
    }

    public function add_act(Request $request){
        $this->validate($request, [
            'act_assigned' => 'required',
        ]);

        $activity = new Activity();
        $activity->student_id = $request->input('student_id');
        $activity->company_id = $request->input('company_id');
        $activity->act_assigned = $request->input('act_assigned');

        if ($activity->save()){
            return redirect()->back()->with('success', 'Activity saved successfully');
        }
        else{
            return redirect()->back()->with('error', 'There was an error saving activity, please try again');
        }
    }

    public function update_act(Request $request){
        $this->validate($request, [
           'act_assigned' => 'required'
        ]);
        $activity_id = $request->input('act_id');
        $activity = Activity::find($activity_id);

        $activity->act_assigned = $request->input('act_assigned');

        if ($activity->update()){
            return redirect()->back()->with('success', 'Activity updated successfully');
        }
        else{
            return redirect()->back()->with('error', 'There was an error updating activity, please try again');
        }

    }

    public function update_profile(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'region' => 'required',
            'district' => 'required',
            'department' => 'required',
            'postal_address' => 'required',
            'password' => 'min:8',
        ]);
        $company = Company::findOrFail($request->company_id);

        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->region = $request->input('region');
        $company->district = $request->input('district');
        $company->department = $request->input('department');
        $company->postal_address = $request->input('postal_address');
        //$company->password = $request->input('password');

        if ($company->update()){
            return redirect()->back()->with('success', 'Profile updated successfully');
        }
        else{
            return redirect()->back()->with('error', 'There was an error updating profile, please try again');
        }

    }

    public function previous_students(){
        $company = Auth::guard('company')->user();

        $today = Carbon::today()->toDateString();
        $raw_students = $company->students->all();
        $students = array();

        foreach ($raw_students as $raw_student){
            $attachment_end = Carbon::make($raw_student->attachment_end)->addDays(30)->toDateString();
            if ($today > $attachment_end){
                $students[] = $raw_student;
            }
        }
        return view('company.previous_student')->with([
            'students' => $students,
            'company' => $company
        ]);
    }

    public function change_password(Request $request){
        $this->validate($request, [
            'id' => 'required',
           'old_password' => 'required|string',
            'new_password' => 'required|string|min:8'
        ]);
        $id = $request->input('id');
        $old_password = $request->input('ol_password');
        $new_password = $request->input('new_password');
        $confirm_password = $request->input('confirm_password');

        if ($confirm_password == $new_password){
            $company = Company::findOrFail($id);
            $db_password = $company->password;
            if (bcrypt($old_password) == $db_password){
                // can update password
                $company->password = $new_password;
                $company->update();
                return redirect()->back()->with('success', 'password changed successfully');
            }
            else{
                return redirect()->back()->with('error', 'new password and user password mismatch');
            }
        }
        else{
            return redirect()->back()->with('error', 'new password and confirmed password mismatch.');
        }
    }
}