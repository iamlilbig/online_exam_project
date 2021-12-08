<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Test;
use Auth;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TestController extends Controller
{
    public function edit($id): Factory|View|Application
    {
        $test = Test::where('id', $id)->first();
        $courses = Auth::user()->courses()->where('ended_at', '>',Carbon::now())->get();
        return view('dashboard.instructors.tests.edit', ['exams' => $test,'courses' => $courses]);
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $validate = Validator::make($request->all(),[
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required'],
            'duration' => ['required', 'integer'],
            'course_id' => ['required','exists:App\Models\Course,id'],
            'time' => ['required',],
            'date' => ['required','date','date_format:Y-m-d',],
        ])->validated();

        if(Test::query()->update($validate)){
            return redirect()
                ->back()
                ->with('success', 'the course is successfully updated');
        }
        return redirect()
            ->back()
            ->with('error', 'Error!');
    }

    public function create(Request $request): Factory|View|Application
    {
        $courses = Auth::user()->courses()->where('ended_at', '>',Carbon::now())->get();
        return view('dashboard.instructors.tests.create',['courses' => $courses]);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required'],
            'duration' => ['required', 'integer'],
            'course_id' => ['required','exists:App\Models\Course,id'],
            'time' => ['required',],
            'date' => ['required','date','date_format:Y-m-d',],
        ])->validated();

        if(Test::query()->create($validate)){
            return redirect()
                ->back()
                ->with('success', 'the course is successfully updated');
        }
        return redirect()
            ->back()
            ->with('error', 'Error!');
    }

    public function active()
    {
        $instructor = Instructor::query()->where('id',Auth::guard('instructor')->user()->id)->first();
        $tests = $instructor->tests->where('date', '>',Carbon::now());
        return view('dashboard.instructors.tests.active',['results' => $tests]);
    }

    public function past()
    {
        $instructor = Instructor::query()->where('id',Auth::guard('instructor')->user()->id)->first();
        $tests = $instructor->tests->where('date', '<',Carbon::now());
        return view('dashboard.instructors.tests.past',['results' => $tests]);
    }

    public function destroy($id)
    {
        Test::destroy($id);
        return redirect(route('instructors.exams.active'));
    }
}
