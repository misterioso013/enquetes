<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poll;

class dashboardController extends Controller
{
    public function __invoke()
    {
        $polls = Poll::all();

        return view('dashboard', ['polls' => $polls]);
    }
}
