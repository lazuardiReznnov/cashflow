<?php

namespace App\Http\Controllers;

use App\Models\acount;
use App\Models\Cashflow;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $cashflow = Cashflow::query();

        $cashflow->when($request->search, function ($query) use ($request) {
            return $query->where('acount_id', '=', $request->search);
        });

        return view('report.index', [
            'title' => 'Report Data',
            'acounts' => acount::all(),
            'datas' => $cashflow
                ->with('acount')
                ->paginate(10)
                ->withQueryString(),
        ]);
    }
}
