<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class InstructorController extends Controller
{
    public function showNewInstructors(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $instructors = Instructor::query()->where('is_confirmed',null)->get();
        return view('dashboard.admins.instructors.new',['instructors' => $instructors]);
    }

    public function showSearchForm(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('dashboard.admins.instructors.search');
    }

    public function search(Request $request)
    {

    }

    public function logout(Request $request): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function confirmation(Request $request,$id): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        if($request->confirmation == 'accept'){
            Instructor::query()->where('id',$id)
                ->update(['is_confirmed' => '1']);
        }else{
            Instructor::query()->where('id',$id)
                ->update(['is_confirmed' => '0']);
        }
        return redirect(route('admin.new.instructors'));
    }


    public function showRegisterForm(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('register.instructors');
    }

    /**
     * @throws ValidationException
     */
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255','unique:instructors'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required','unique:instructors','string','regex:/09(1[0-9]|9[0-9]|0[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}/'],
        ])->validated();

        if(Instructor::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => Hash::make($validate['password']),
            'phone' => $validate['phone'],
        ])){
            return redirect(route('login.instructors'))
                ->with('success', 'your account is register, please wait to confirm');

        }
    }

    public function showLoginForm(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('login.instructors');
    }

    public function login(Request $request): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {

        $credentials = ['email' => $request->post('email'), 'password' => $request->post('password'),'is_confirmed' => '1','is_active' => '1'];

        if(Auth::guard('instructor')->attempt($credentials)){
            abort(200);
            return redirect(route('home'));
        }

        return redirect()
            ->back()
            ->withErrors('your inputs are invalid or your account is not confirmed');
    }
}
