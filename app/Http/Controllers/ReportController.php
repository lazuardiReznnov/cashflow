<?php

namespace App\Http\Controllers;

use App\Models\acount;
use App\Models\Cashflow;
use App\Models\tag;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        return view('report.index', [
            'title' => 'Report Data',
            'datas' => acount::with('cashflow')
                ->latest()
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    public function tagdetail($id)
    {
        $tags = tag::find($id);
        return view('report.tag-detail', [
            'title' => 'Detail Tag-' . $tags->name,
            'datas' => $tags->cashflows,
        ]);
    }
}
