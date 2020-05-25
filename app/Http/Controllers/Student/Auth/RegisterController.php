<?php

namespace App\Http\Controllers\Student\Auth;

use App\Student;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new admins as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/staff/add_student';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('student.guest:student');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'second_name' => 'required|max:255',
            'index_number' => 'required|min:8|max:8|unique:students',
            'level'=> 'required|min:3|max:3',
            'course'=>'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Student
     */
    protected function create(array $data)
    {
        return Student::create([
            'first_name' => $data['first_name'],
            'second_name' => $data['second_name'],
            'other_name' => $data['other_name'],
            'index_number' => $data['index_number'],
            'level' => $data['level'],
            'course' => $data['course'],
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
//    public function showRegistrationForm()
//    {
//        return view('student.auth.register');
//    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('student');
    }

}
