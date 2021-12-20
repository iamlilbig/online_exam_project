<?php

namespace App\Http\Middleware;

use App\Models\Result;
use App\Models\Test;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StartExam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $id = $request->route('id');
        if(Result::query()->where('test_id',$id)->where('student_id',Auth::user()->id)->exists()){
            $result = Result::query()->where('test_id',$id)->where('student_id',Auth::user()->id)->first();
            if($result->ended_at > Carbon::now()){
                return $next($request);
            }
            return redirect()
                ->route('students.home')
                ->with('error','You have already taken this exam');
        }
        $exam = Test::find($id);
        Result::query()->create([
            'test_id' => $id,
            'student_id' => Auth::user()->id,
            'ended_at' => now()->addMinutes($exam->duration)->format('Y-m-d H:i:s')
        ]);
        return $next($request);
    }
}
