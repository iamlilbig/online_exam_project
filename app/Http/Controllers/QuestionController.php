<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function createMultipleChoice(): Factory|View|Application
    {
        $tests = Auth::user()->tests->where('date', '>',Carbon::now());
        return view('dashboard.instructors.questions.create.multipleChoice',['exams'=> $tests]);
    }

    public function createDescriptive(): Factory|View|Application
    {
        $tests = Auth::user()->tests->where('date', '>',Carbon::now());
        return view('dashboard.instructors.questions.create.descriptive',['exams'=> $tests]);
    }

    public function storeDescriptive(Request $request): RedirectResponse
    {
        $validated = Validator::make($request->all(),
        [
         'title' => 'required|string|max:50',
         'content' => 'required|string',
         'test_id' => 'integer|min:1',
         'default_score' => 'integer|min:1',
        ])->validated();

        $question = Question::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'instructor_id' => Auth::user()->id,
            'question_type_id' => '1'
        ]);

        if(isset($validated['test_id'])){
            $question->tests()->attach($validated['test_id'],['default_score'=> $validated['default_score']]);
        }

        return redirect()
            ->route('instructors.questions.index.descriptive')
            ->with('success','question created successfully');

    }

    public function storeMultipleChoice(Request $request)
    {
        $validated = Validator::make();

    }

    public function indexDescriptive()
    {
        $questions = Auth::user()->questions()->where('question_type_id',1)->get();
        return view('dashboard.instructors.questions.index.descriptive',['results'=>$questions]);
    }

    public function indexMultipleChoice()
    {
        $questions = Auth::user()->questions()->where('question_type_id',2)->get();
        return view('dashboard.instructors.questions.index.multipleChoice',['results'=>$questions]);
    }

    public function deleteDescriptive()
    {

    }

    public function deleteMultipleChoice()
    {

    }

    public function editDescriptive()
    {

    }

    public function editMultipleChoice()
    {

    }

    public function updateDescriptive()
    {

    }

    public function updateMultipleChoice()
    {

    }
}
