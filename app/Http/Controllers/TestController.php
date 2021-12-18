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
use function PHPUnit\Framework\isNull;

class TestController extends Controller
{
    public function addQuestion($id,Request $request): RedirectResponse
    {

        if(!is_array($request->select)){
            $selected = [$request->select];
        }else{
            $selected = $request->select;
        }
        $exam = Test::find($id);
        foreach ($selected as $select){
            $score = 'score' . $select;
            if(!(!$request->$score)){
            $exam->questions()->attach($select,['default_score' => $request->$score]);

            }
        }
        return redirect()
            ->route('instructors.exams.edit',$id)
            ->with('success','the questions added successfully');
    }

    public function questionBank($id): Factory|View|Application
    {
        $exam = Test::find($id);
        $questions = Auth::user()->questions()->get();
        return view('dashboard.instructors.questions.select',['exam' => $exam,'results' => $questions]);
    }

    public function deleteQuestion(Request $request,$id): RedirectResponse
    {
        $test = Test::find($id);
        $test->questions()->detach($request->question_id);
        return redirect()
            ->back()
            ->with('success', 'the question has been deleted');
    }

    public function edit($id): Factory|View|Application
    {
        $test = Test::where('id', $id)->first();
        $courses = Auth::user()->courses()->where('ended_at', '>',Carbon::now())->get();
        $questions = $test->questions;
        return view('dashboard.instructors.tests.edit', ['exams' => $test,'courses' => $courses,'results' => $questions]);
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
        $validate['datetime'] = $validate['date'].'T'.$validate['time'];
        unset($validate['date']);
        unset($validate['time']);
        if(Test::query()->where('id',$id)->update($validate)){
            return redirect()
                ->route('instructors.exams.active')
                ->with('success', 'the exam is successfully updated');
        }
        return redirect()
            ->back()
            ->with('error', 'Error!');
    }

    public function create(): Factory|View|Application
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
        $validate['datetime'] = $validate['date'].' '.$validate['time'].':00';
        unset($validate['date']);
        unset($validate['time']);
        if(Test::query()->create($validate)){
            return redirect()
                ->route('instructors.exams.active')
                ->with('success', 'the exam is successfully created');
        }
        return redirect()
            ->back()
            ->with('error', 'Error!');
    }

    public function active(): Factory|View|Application
    {
        $instructor = Instructor::query()->where('id',Auth::guard('instructor')->user()->id)->first();
        $tests = $instructor->tests->where('datetime', '>',Carbon::now());
        $default = [];
        foreach ($tests as $exam){
            $sum = 0;
            foreach ($exam->questions as $question){
                $sum += $question->pivot->default_score;
            }
            $default[$exam->title] = $sum;
        }
        return view('dashboard.instructors.tests.active',['results' => $tests,'scores'=>$default]);
    }

    public function past()
    {
        $instructor = Instructor::query()->where('id',Auth::guard('instructor')->user()->id)->first();
        $tests = $instructor->tests->where('datetime', '<',Carbon::now());
        $default = [];
        foreach ($tests as $exam){
            $sum = 0;
            foreach ($exam->questions as $question){
                $sum += $question->pivot->default_score;
            }
            $default[$exam->title] = $sum;
        }
        return view('dashboard.instructors.tests.past',['results' => $tests,'scores'=>$default]);
    }

    public function destroy($id)
    {
        Test::destroy($id);
        return redirect(route('instructors.exams.active'));
    }
}
