<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Result;
use App\Models\Test;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function sent(): Factory|View|Application
    {
        $results = Auth::user()->tests()->where('is_sent',1)->withCount('results')->get();
        return view('dashboard.instructors.results.sent',['results' => $results]);
    }

    public function unsent(): Factory|View|Application
    {
        $results = Auth::user()->tests()->where('endtime','<',now())->whereNull('is_sent')->withCount('results')->get();
        return view('dashboard.instructors.results.unsent',['results' => $results]);
    }

    public function show(Test $test)
    {
        $results = $test->results()->with('student')->get();
        return view('dashboard.instructors.results.show',['results'=>$results]);
    }

    public function showSent(Test $test)
    {
        $results = $test->results()->with('student')->get();
        return view('dashboard.instructors.results.showsent',['results'=>$results]);
    }

    public function check(Result $result)
    {
        $results = $result->answers()->with('question',function($question) use ($result) {
            return $question->with('tests',function($tests) use ($result) {
                return $tests->find($result->test_id);
            })->get();
        })->get();
        $student = $result->student()->first();
        return view('dashboard.instructors.results.check',['results'=>$results,'student'=>$student]);
    }

    public function checked(Result $result)
    {
        $results = $result->answers()->with('question')->get();
        $student = $result->student();
        return view('dashboard.instructors.results.checked',['results'=>$results,'student'=>$student]);
    }

    public function checking(Request $request,Result $result)
    {
        $answers = $result->answers()->with('question',function($question){
            return $question->where('question_type_id','1')->get();
        })->get();

        foreach($request->score as $key => $value){
            if($value == null){
                return redirect()
                    ->back()
                    ->with('error','enter score of questions' );
            }
            if($value > $request->default_score[$key]){
                return redirect()
                    ->back()
                    ->with('error','score must be lesser than default score' );
            }
            Answer::query()->find($request->answer_id[$key])->update([
                'score' => $value
            ]);
        }
        $total = $result->answers()->sum('score');
        $result->update([
            'score' => $total,
            'is_checked' => 1,
        ]);

        return redirect()
            ->route('instructors.results.unsent.show',['test' => $result->test])
            ->with('success','result is checked!');
    }

    public function send(Test $test)
    {
        dd('send');
    }

}
