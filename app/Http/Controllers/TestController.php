<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Test;
use Auth;
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
        return view('dashboard.instructors.tests.edit', ['exams' => $test]);
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
        return view('dashboard.instructors.tests.create');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required'],
            'duration' => ['required', 'integer'],
            'time' => ['required',],
            'date' => ['required','date','date_format:Y-m-d',],
        ])->validated();
//TODO
    }

    public function active()
    {

    }

    public function past()
    {
        $instructor = Instructor::query()->where('id',Auth::guard('instructor')->user()->id)->first();
        $tests = $instructor->courses();
        dd($tests->tests);
    }
}
