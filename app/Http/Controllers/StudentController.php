<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Notification;
use App\Models\Student;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class StudentController extends Controller
{
    public function deleteNotification($id): RedirectResponse
    {
        Notification::query()->where('id',$id)->delete();
        return redirect()
            ->route('students.notifications')
            ->with('success','notification successfully deleted!');
    }
    public function readNotification($id): RedirectResponse
    {
        if($id == 'all'){
            (Auth::user())->unreadNotifications->markAsRead();
        }else{
            Notification::query()->where('id',$id)->update([
                'read_at' => now()
            ]);
        }
        return redirect()
            ->route('students.notifications');
    }

    public function notifications(): Factory|View|Application
    {
        $unreadNotifications = Auth::user()->unreadNotifications()->where('deleted_at',null)->get();
        $notifications = Auth::user()->readNotifications()->where('deleted_at',null)->get();
        return view('dashboard.students.notification',['unreadNotifications'=> $unreadNotifications,'readNotifications'=> $notifications]);
    }

    public function futureExams()
    {
        $user = Auth::user();
        $courses = $user->courses()->get();
        $exams = [];
        foreach ($courses as $course){
            $exams[$course->id] = $course->tests()->where('datetime','>',Carbon::now())->get();
        }
        $default = [];
        foreach ($exams as $test){
            foreach($test as $exam) {
                $sum = 0;
                foreach ($exam->questions as $question) {
                    $sum += $question->pivot->default_score;
                }
                $default[$exam->title] = $sum;
            }
        }
        return view('dashboard.students.exams.future',['results'=>$exams,'scores'=>$default]);
    }

    public function activeExams()
    {
        $user = Auth::user();
        $courses = $user->courses()->get();
        $exams = [];
        foreach ($courses as $course){
            $exams[$course->id] = $course->tests()->where('datetime','<',Carbon::now())->where('endtime','>',Carbon::now())->get();
        }
        $default = [];
        foreach ($exams as $test){
            foreach($test as $exam) {
                $sum = 0;
                foreach ($exam->questions as $question) {
                    $sum += $question->pivot->default_score;
                }
                $default[$exam->title] = $sum;
            }
        }
        return view('dashboard.students.exams.active',['results'=>$exams,'scores'=>$default]);
    }

    public function exams($id)
    {
        $exams = (Course::find($id))->tests()->where('endtime','>',Carbon::now())->where('datetime','<',Carbon::now())->get();
        $default = [];
            foreach($exams as $exam) {
                $sum = 0;
                foreach ($exam->questions as $question) {
                    $sum += $question->pivot->default_score;
                }
                $default[$exam->title] = $sum;
        }
        return view('dashboard.students.courses.show',['results'=>$exams,'scores'=>$default]);
    }

    public function courses()
    {
        $courses = Auth::user()->courses()->get();

        return view('dashboard.students.courses.active',['results'=>$courses]);
    }

    public function dashboard()
    {
        return view('dashboard.students.dashboard');
    }

    public function edit($id): Factory|View|Application
    {
        if($user=Student::find($id)){
            return view('dashboard.admins.students.edit', ['user' => $user]);
        }
        return redirect()->back();
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request)
    {
        if($request->password){
            $validate = Validator::make($request->all(),[
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255',Rule::unique('students')->ignore($request->id)],
                'is_active' => ['required'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'phone' => ['required',Rule::unique('students')->ignore($request->id),'regex:/09(1[0-9]|9[0-9]|0[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}/'],
            ])->validated();

            if(Student::query()->where('id',$request->id)->update([
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
                'email' => ['required', 'string', 'email', 'max:255',Rule::unique('students')->ignore($request->id)],
                'is_active' => ['required'],
                'phone' => ['required',Rule::unique('students')->ignore($request->id),'string','regex:/09(1[0-9]|9[0-9]|0[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}/'],
            ])->validated();
            if(Student::query()->where('id',$request->id)->update([
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

    public function showSearchForm(): Factory|View|Application
    {
        return view('dashboard.admins.students.search');
    }

    /**
     * @throws ValidationException
     */
    public function search(Request $request): Factory|View|Application
    {

        if($request->searchMethod == 'id'){
            $validate = Validator::make($request->all(),[
                'search' => ['required', 'integer', 'max:255'],
                'searchMethod' => ['required','string'],
            ])->validated();

            $results = Student::query()->where('id',$validate['search'])->get();
        }else{
            $validate = Validator::make($request->all(),[
                'search' => ['required', 'string', 'max:255'],
                'searchMethod' => ['required','string', ],
            ])->validated();
            $results = Student::query()->where($validate['searchMethod'],'regexp',$validate['search'])->get();
        }
        return view('dashboard.admins.students.search',['results' => $results]);
    }

    public function showNewStudents(): Factory|View|Application
    {
        $students = Student::where('is_confirmed',null)->get();
        return view('dashboard.admins.students.new',['students' => $students]);
    }

    public function confirmation(Request $request,$id): Redirector|Application|RedirectResponse
    {
//        dd($id,$request->all());
    if($request->confirmation == 'accept'){
        Student::where('id',$id)
            ->update(['is_confirmed' => '1','is_active' => '1']);
    }else{
        Student::where('id',$id)
            ->update(['is_confirmed' => '0','is_active' => '0']);
    }
    return redirect(route('admin.new.students'));
    }


    public function showLoginForm(): Factory|View|Application
    {
        return view('login.students');
    }

    /**
     * @throws ValidationException
     */
    public function login(Request $request): Redirector|Application|RedirectResponse
    {

        $credentials = ['email' => $request->post('email'), 'password' => $request->post('password'),'is_confirmed' => '1','is_active' => '1'];



        if(Auth::guard('student')->attempt($credentials)){
            return redirect(route('students.home'));
        }
        return redirect()->back()->withErrors('your inputs are invalid or your account is not confirm');
    }

    public function logout(Request $request): Redirector|Application|RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showRegisterForm(): Factory|View|Application
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

        if(Student::query()->create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => Hash::make($validate['password']),
            'phone' => $validate['phone'],
        ])){
            return redirect(route('login.students'))
                ->with('success', 'your account is register, please wait to confirmed');

        }

    }

    public function active(): Factory|View|Application
    {
        $students = Student::query()->where('is_active','1')->get();
        return view('dashboard.admins.students.active',['results' => $students]);
    }

    public function inactive(): Factory|View|Application
    {
        $students = Student::query()->where('is_active','0')->get();
        return view('dashboard.admins.students.inactive',['results' => $students]);
    }
}
