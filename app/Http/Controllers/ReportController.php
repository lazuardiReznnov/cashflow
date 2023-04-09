<?php

namespace App\Http\Controllers;

use App\Models\acount;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        return view('report.index', [
            'title' => 'Report Data',
            'datas' => acount::with('cashflow')
                ->paginate()
                ->withQueryString(),
        ]);
    }
}
