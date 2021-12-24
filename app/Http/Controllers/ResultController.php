<?php

namespace App\Http\Controllers;

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
        $results = Auth::user()->tests()->where('endtime','<',now())->where('is_sent',0)->withCount('results')->get();
        return view('dashboard.instructors.results.unsent',['results' => $results]);
    }

    public function show(Test $test)
    {
        dd('show');
        $results = $test->results()->get();
        return view('dashboard.instructors.results.sent',['results'=>$results]);
    }

    public function showSent(Test $test)
    {
        dd('show sent');
        $results = $test->results()->get();
        return view('dashboard.instructors.results.showsent',['results'=>$results]);
    }

    public function send(Test $test)
    {
        dd('send');
    }

}
