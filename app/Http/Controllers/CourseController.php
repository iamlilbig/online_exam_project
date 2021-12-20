<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Instructor;
use App\Models\Student;
use App\Notifications\AddToCourse;
use App\Notifications\DeletedFromCourse;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
            Instructor::find($validate['instructor_id'])->notify(new AddToCourse(Course::where('unique_id',$validate['unique_id'])->first()));
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

    public function edit(Request $request,$id)
    {
        $course = Course::find($id);
        $students = $course->students;
        $instructors = Instructor::query()->where('is_active','1')->get();
        return view('dashboard.admins.courses.info',['course' => $course,'results' => $students,'instructors' => $instructors]);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(),[
            'unique_id' => ['required', 'string', 'max:255',Rule::unique('students')->ignore($request->id)],
            'title' => ['required', 'string', 'max:255'],
            'instructor_id' => ['required', 'integer'],
            'description' => ['required'],
            'started_at' => ['required', 'date',],
            'ended_at' => ['required', 'date','after_or_equal:started_at']
        ])->validated();
        if(Course::update([
            'unique_id' => $validate['unique_id'],
            'title' => $validate['title'],
            'instructor_id' => $validate['instructor_id'],
            'description' => $validate['description'],
            'started_at' => $validate['started_at'],
            'ended_at' => $validate['ended_at'],
        ])){
            return redirect()
                ->back()
                ->with('success', 'the course is successfully updated');

        }
    }

    public function deleteStudent(Request $request,$id)
    {
        $course = Course::find($id);
        CourseStudent::where('course_id',$id)->where('student_id',$request->student_id)->delete();
        Student::find($request->student_id)->notify(new DeletedFromCourse($course));
        return redirect()
            ->back()
            ->with('success', 'the student successfully deleted');
    }

    public function addStudent(Request $request,$id)
    {
        $course = Course::find($id);
        if ($course->students()->where('student_id',$request->student_id)->exists()) {
            return redirect()
                ->back()
                ->with('error', 'student already exist!');
        }
        if(Student::find($request->student_id)){
//            $course->students()->attach($request->student);
            CourseStudent::create([
                'course_id' => $id,
                'student_id' =>$request->student_id
            ]);
            Student::find($request->student_id)->notify(new AddToCourse($course));
            return redirect()
                ->back()
                ->with('success', 'the student successfully added!');
        }
        return redirect()
            ->back()
            ->with('error', 'the student not exist!');
    }
}
