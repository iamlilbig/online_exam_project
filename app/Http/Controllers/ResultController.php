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
        $results = Auth::user()->tests()->with('results')->get()->where('is_sent',0);
        return view('dashboard.instructors.results.sent',['results' => $results]);
    }

    public function unsent(): Factory|View|Application
    {
        $results = Auth::user()->tests()->with('results')->get()->where('is_sent',0);
        return view('dashboard.instructors.results.sent',['results' => $results]);
    }

    public function unchecked(): Factory|View|Application
    {
        $results = Auth::user()
            ->tests()
            ->where('endtime','>',now())
            ->where('is_sent',0)->get();
        return view('dashboard.instructors.results.unchecked',['results' => $results]);
    }

    public function checked(): Factory|View|Application
    {
        $results = Auth::user()
            ->tests()
            ->where('endtime','>',now())
            ->where('is_sent',1)->get();
        return view('dashboard.instructors.results.unchecked',['results' => $results]);
    }
}
