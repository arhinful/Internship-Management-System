<?php

namespace App\Http\Controllers\Staff;

use App\Company;
use App\Http\Controllers\Controller;
use App\Setting;
use App\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    protected $redirectTo = '/staff/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('staff.auth:staff');
    }

    /**
     * Show the Staff dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('staff.home');
    }

    public function all_students(){
        $students_pp = Setting::find(1)->students_pp;

        $students = Student::orderBy('created_at', 'desc')->paginate($students_pp);
        return view('staff.student.all_students')->with('students', $students);
    }

    public function add_student(){
        return view('staff.student.add_student');
    }

    public function single_student($id){
        $student = Student::findOrFail($id);
        return view('staff.student.single_student')->with('student', $student);
    }

    public function register_student(Request $request){
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'second_name' => 'required|max:255',
            'index_number' => 'required|min:8|max:8|unique:students',
            'level'=> 'required|min:3|max:3',
            'course'=>'required'
        ]);

        $student = new Student();
        $student->first_name = $request->input('first_name');
        $student->second_name = $request->input('second_name');
        $student->other_name = $request->input('other_name');
        $student->index_number = $request->input('index_number');
        $student->level = $request->input('first_name');
        $student->course = $request->input('course');

        if ($student->save()){
            return view('staff.student.add_student')->with('success', 'Student Added Successfully');
        }
        else{
            return view('staff.student.add_student')->with('error', 'There was an error Adding Student, please try again');
        }
    }

    public function all_students_score(){
        $students_pp = Setting::find(1)->students_pp;
        $students = Student::where('score', '!=', null)->paginate($students_pp);
        return view('staff.student.all_students_score')->with('students', $students);
    }

    public function registered_companies(){
        $students_pp = Setting::find(1)->students_pp;
        $companies = Company::orderBy('created_at', 'desc')->paginate($students_pp);
        return view('staff.company.registered_companies')->with('companies', $companies);
    }

    public function single_company($id){
        $company  = Company::findOrFail($id);
        return view('staff.company.single_company')->with('company', $company);
    }

    public function current_students($company_id){
        $students = array();
        $company = Company::findOrFail($company_id);
        $students_raw = $company->students->all();
        foreach ($students_raw as $student){
            $end_date = Carbon::make($student->attachment_end)->addDays(120)->toDateString();
            $today = Carbon::now()->toDateString();
            if ($today < $end_date){
                $students[] = $student;
            }
        }
        return view('staff.company.current_students')->with('students', $students);
    }

    public function previous_students($company_id){
        $students = array();
        $company = Company::findOrFail($company_id);
        $students_raw = $company->students->all();
        foreach ($students_raw as $student){
            $end_date = Carbon::make($student->attachment_end)->addDays(120)->toDateString();
            $today = Carbon::now()->toDateString();
            if ($today > $end_date){
                $students[] = $student;
            }
        }
        return view('staff.company.previous_students')->with('students', $students);
    }

    public function activities($id){
        $student = Student::findOrFail($id);
        $activities = $student->activities->all();

        return view('staff.student.activities')->with([
            'student'=>$student,
            'activities'=>$activities
        ]);
    }

    public function settings(){
        $settings = Setting::findOrFail(1);
        return view('staff.settings')->with('settings', $settings);
    }

    public function update_settings(Request $request){
        $this->validate($request, [
           'attachment_period' => 'required',
            'students_pp' => 'required'
        ]);
        $settings = Setting::findOrFail(1);

        $settings->attachment_period = $request->input('attachment_period');
        $settings->students_pp = $request->input('students_pp');

        if ($settings->update()){
            return redirect()->back()->with('success', 'Settings updated successfully');
        }
        else{
            return redirect()->back()->with('error', 'There was an error updating settings, please try again');
        }
    }

}