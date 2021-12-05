<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class StudentController extends Controller
{


    public function showSearchForm(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('dashboard.admins.students.search');
    }

    public function search(Request $request)
    {

    }

    public function showNewStudents()
    {
        $students = Student::where('is_confirmed',null)->get();
        return view('dashboard.admins.students.new',['students' => $students]);
    }

    public function confirmation(Request $request,$id)
    {
//        dd($id,$request->all());
    if($request->confirmation == 'accept'){
        Student::where('id',$id)
            ->update(['is_confirmed' => '1']);
    }else{
        Student::where('id',$id)
            ->update(['is_confirmed' => '0']);
    }
    return redirect(route('admin.new.students'));
    }


    public function showLoginForm(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('login.students');
    }

    /**
     * @throws ValidationException
     */
    public function login(Request $request): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {

        $credentials = ['email' => $request->post('email'), 'password' => $request->post('password'),'is_confirmed' => '1','is_active' => '1'];



        if(Auth::guard('student')->attempt($credentials)){
            abort(200);
            return redirect(route('home'));
        }
        return redirect()->back()->withErrors('your inputs are invalid or your account is not confirm');
    }

    public function logout(Request $request): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showRegisterForm(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('register.students');
    }

    /**
     * @throws ValidationException
     */
    public function Register(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255','unique:students'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required','unique:students','string','regex:/09(1[0-9]|9[0-9]|0[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}/'],
        ])->validated();

        if(Student::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => Hash::make($validate['password']),
            'phone' => $validate['phone'],
        ])){
            return redirect(route('login.students'))
                ->with('success', 'your account is register, please wait to confirmed');

        }

    }
}
