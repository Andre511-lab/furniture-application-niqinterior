<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\ActivityLogger;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $request->subject = 'J';
        $request->description = 'dashboard';

        insertActivity($request);


        return view('dashboard');
    }
}
