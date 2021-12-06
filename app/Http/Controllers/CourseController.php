<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Instructor;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function create(): Factory|View|Application
    {
        $instructors = Instructor::query()->where('is_active','1')->get();
        return view('dashboard.admins.courses.create',['instructors' => $instructors]);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'unique_id' => ['required', 'string', 'max:255', 'unique:courses'],
            'title' => ['required', 'string', 'max:255'],
            'instructor_id' => ['required', 'integer'],
            'description' => ['required'],
            'started_at' => ['required', 'date',],
            'ended_at' => ['required', 'date','after_or_equal:started_at']
        ])->validated();
        if(Course::create([
            'unique_id' => $validate['unique_id'],
            'title' => $validate['title'],
            'instructor_id' => $validate['instructor_id'],
            'description' => $validate['description'],
            'started_at' => $validate['started_at'],
            'ended_at' => $validate['ended_at'],
        ])){
            return redirect(route('admin.courses.active'))
                ->with('success', 'the course is successfully created');

        }
    }

    public function activeCourses(): Factory|View|Application
    {
        $courses = Course::where('ended_at', '>',Carbon::now())->get();
        return view('dashboard.admins.courses.active',['results' => $courses]);
    }

    public function pastCourses()
    {
        $courses = Course::where('ended_at', '<',Carbon::now())->get();
        return view('dashboard.admins.courses.past',['results' => $courses]);
    }
}
