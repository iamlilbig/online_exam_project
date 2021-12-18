<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Instructor;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class InstructorController extends Controller
{
    public function __construct()
    {
//        $this->middleware('can:instructor');
//        $this->middleware('can:admin');
    }

    public function edit($id): Application|Factory|View
    {
        if($users = Instructor::query()->where('id',$id)->get()){
        foreach($users as $user)
        return view('dashboard.admins.instructors.edit',['user' => $user]);
        }
            return redirect()->back();
    }

    public function update(Request $request)
    {
        if($request->password){
            $validate = Validator::make($request->all(),[
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255',Rule::unique('instructors')->ignore($request->id)],
                'is_active' => ['required'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'phone' => ['required',Rule::unique('instructors')->ignore($request->id),'regex:/09(1[0-9]|9[0-9]|0[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}/'],
            ])->validated();

            if(Instructor::query()->where('id',$request->id)->update([
                'name' => $validate['name'],
                'email' => $validate['email'],
                'is_active' => $validate['is_active'],
                'is_confirmed' => $validate['is_active'],
                'password' => Hash::make($validate['password']),
                'phone' => $validate['phone'],
            ])){
                return redirect()
                    ->back()
                    ->with('success', 'Updated successfully');

            }
        }else{
            $validate = Validator::make($request->all(),[
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255',Rule::unique('instructors')->ignore($request->id)],
                'is_active' => ['required'],
                'phone' => ['required',Rule::unique('instructors')->ignore($request->id),'string','regex:/09(1[0-9]|9[0-9]|0[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}/'],
            ])->validated();
            if(Instructor::query()->where('id',$request->id)->update([
                'name' => $validate['name'],
                'email' => $validate['email'],
                'is_active' => $validate['is_active'],
                'is_confirmed' => $validate['is_active'],
                'phone' => $validate['phone'],
            ])){
                return redirect()
                    ->back()
                    ->with('success', 'Updated successfully');

            }
        }
    }

    public function showNewInstructors(): Factory|View|Application
    {
        $instructors = Instructor::query()->where('is_confirmed',null)->get();
        return view('dashboard.admins.instructors.new',['instructors' => $instructors]);
    }

    public function showSearchForm(): Factory|View|Application
    {
        return view('dashboard.admins.instructors.search');
    }

    /**
     * @throws ValidationException
     */
    public function search(Request $request)
    {


        if($request->searchMethod == 'id'){
            $validate = Validator::make($request->all(),[
                'search' => ['required', 'integer', 'max:255'],
                'searchMethod' => ['required','string'],
            ])->validated();

            $results = Instructor::query()->where('id',$validate['search'])->get();
        }else{
            $validate = Validator::make($request->all(),[
                'search' => ['required', 'string', 'max:255'],
                'searchMethod' => ['required','string', ],
            ])->validated();
            $results = Instructor::query()->where($validate['searchMethod'],'regexp',$validate['search'])->get();
        }



        return view('dashboard.admins.instructors.search',['results' => $results]);
    }

    public function logout(Request $request): Redirector|Application|RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function confirmation(Request $request,$id): Redirector|Application|RedirectResponse
    {
        if($request->confirmation == 'accept'){
            Instructor::query()->where('id',$id)
                ->update(['is_confirmed' => '1','is_active'=>'1']);
        }else{
            Instructor::query()->where('id',$id)
                ->update(['is_confirmed' => '0','is_active' => '0']);
        }
        return redirect(route('admin.new.instructors'));
    }


    public function showRegisterForm(): Factory|View|Application
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

    public function showLoginForm(): Factory|View|Application
    {
        return view('login.instructors');
    }

    public function login(Request $request): Redirector|Application|RedirectResponse
    {

        $credentials = ['email' => $request->post('email'), 'password' => $request->post('password'),'is_confirmed' => '1','is_active' => '1'];

        if(Auth::guard('instructor')->attempt($credentials)){
            return redirect(route('instructors.home'));
        }

        return redirect()
            ->back()
            ->withErrors('your inputs are invalid or your account is not confirmed');
    }

    public function dashboard(): Factory|View|Application
    {
        return view('dashboard.instructors.dashboard');
    }

    public function active(): Factory|View|Application
    {
        $instructors = Instructor::query()->where('is_active','1')->get();
        return view('dashboard.admins.instructors.active',['results' => $instructors]);
    }

    public function inactive(): Factory|View|Application
    {
        $instructors = Instructor::query()->where('is_active','0')->get();
        return view('dashboard.admins.instructors.inactive',['results' => $instructors]);
    }

    public function activeCourses(): Factory|View|Application
    {
        $courses = Auth::user()->courses()->where('ended_at', '>',Carbon::now())->get();
        return view('dashboard.instructors.courses.active',['results' => $courses]);
    }

    public function pastCourses(): Factory|View|Application
    {
        $courses = Auth::user()->courses()->where('ended_at', '<',Carbon::now())->get();
        return view('dashboard.instructors.courses.past',['results' => $courses]);
    }

    public function show($id): Factory|View|Application
    {
        $course = Course::find($id);
        $students = $course->students;
        $exams = $course->tests;
        $default = [];
        foreach ($exams as $exam){
            $sum = 0;
            foreach ($exam->questions as $question){
                $sum += $question->pivot->default_score;
            }
            $default[$exam->title] = $sum;
        }
        return view('dashboard.instructors.courses.show',['course'=>$course,'students'=>$students,'exams'=>$exams,'scores'=>$default]);
    }
}
