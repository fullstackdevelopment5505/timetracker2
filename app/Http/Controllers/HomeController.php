<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\Report;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect('timesheet');
    }

    public function export(Request $request) {

        return Excel::download(new Report, 'report.xlsx');
    }
}
