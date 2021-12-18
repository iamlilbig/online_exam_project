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
        $tests = Auth::user()->tests->where('datetime', '>',Carbon::now());
        return view('dashboard.instructors.questions.create.multipleChoice',['exams'=> $tests]);
    }

    public function createDescriptive(): Factory|View|Application
    {
        $tests = Auth::user()->tests->where('datetime', '>',Carbon::now());
        return view('dashboard.instructors.questions.create.descriptive',['exams'=> $tests]);
    }

    public function storeDescriptive(Request $request): RedirectResponse
    {
        $validated = Validator::make($request->all(),
        [
         'title' => 'required|string|max:50',
         'content' => 'required|string',
         'test_id' => 'required|min:1',
         'default_score' => 'required|integer|min:1',
        ])->validated();

        $question = Question::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'instructor_id' => Auth::user()->id,
            'question_type_id' => '1',
        ]);

        if($request->test_id != "") {
            $question->tests()->attach($validated['test_id'], ['default_score' => $validated['default_score']]);
        }

        return redirect()
            ->route('instructors.questions.index.descriptive')
            ->with('success','question created successfully');

    }

    public function storeMultipleChoice(Request $request): RedirectResponse
    {

        $validated = Validator::make($request->all(),[
            'title' => 'required|string|max:50',
            'content' => 'required|string',
            'test_id' => 'required|min:1',
            'default_score' => 'required|integer|min:1',
            'answers' => 'required|array',
            'correct_answer' => 'required|integer|min:1|max:'.count($request->answers),
            ])->validated();


        $question = Question::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'instructor_id' => Auth::user()->id,
            'question_type_id' => '2',
            'answers' => $validated['answers'],
            'correct_answer' => $validated['correct_answer'],
        ]);

        if($request->test_id != "") {
            $question->tests()->attach($validated['test_id'], ['default_score' => $validated['default_score']]);
        }

        return redirect()
            ->route('instructors.questions.index.multipleChoice')
            ->with('success','question created successfully');

    }

    public function indexDescriptive(): Factory|View|Application
    {
        $questions = Auth::user()->questions()->where('question_type_id',1)->get();
        return view('dashboard.instructors.questions.index.descriptive',['results'=>$questions]);
    }

    public function indexMultipleChoice(): Factory|View|Application
    {
        $questions = Auth::user()->questions()->where('question_type_id',2)->get();
        return view('dashboard.instructors.questions.index.multipleChoice',['results'=>$questions]);
    }

    public function destroy($id): RedirectResponse
    {
        Question::destroy($id);
        return redirect()
            ->back()
            ->with('success','Question Deleted successfully');
    }

}
