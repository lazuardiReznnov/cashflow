<?php

namespace App\Http\Controllers;

use App\Models\acount;
use App\Models\Cashflow;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\CashflowExport;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\support\Facades\Storage;

class CashController extends Controller
{
    public function index()
    {
        $saldo2 = 0;
        $saldos = Cashflow::select('debet', 'credit')
            ->where('tgl', '<', date('Y-m-d'))
            ->get();

        foreach ($saldos as $saldo) {
            $saldo2 = $saldo2 + $saldo->credit - $saldo->debet;
        }

        return view('cash.index', [
            'title' => 'Cash Keluar Masuk',
            'saldo' => $saldo2,
            'datas' => Cashflow::with('acount', 'image')
                ->where('tgl', '=', date('Y-m-d'))
                ->orderBY('tgl', 'ASC')
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    public function create()
    {
        return view('cash.create', [
            'title' => 'Add Transaction',
            'datas' => acount::all(),
        ]);
    }
    public function createin()
    {
        return view('cash.create-in', [
            'title' => 'Add Transaction',
            'datas' => acount::where('state', '=', 0)->get(),
        ]);
    }

    public function createout()
    {
        return view('cash.create-out', [
            'title' => 'Add Transaction',
            'datas' => acount::where('state', '=', 1)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'acount_id' => 'required',
            'description' => 'required',
            'tgl' => 'required',
            'debet' => 'required',
            'credit' => 'required',
        ]);

        $validatedData['slug'] = Str::slug(
            rand(10, 100) .
                $request->acount_id .
                $request->tgl .
                $request->description,
            '-'
        );

        $cashflow = Cashflow::create($validatedData);

        if ($request->file('url')) {
            $valid = $request->validate(['url' => 'image|file|max:2048']);
            $valid['url'] = $request->file('url')->store('cashflow-url');
            $cashflow->image()->create($valid);
        }

        return redirect('/cash')->with('success', 'data Telah Tersimpan');
    }

    public function edit(Cashflow $cashflow)
    {
        return view('cash.edit', [
            'title' => 'Edit Transaction',
            'acount' => acount::all(),
            'data' => $cashflow->load('image'),
        ]);
    }

    public function update(Request $request, Cashflow $cashflow)
    {
        $validatedData = $request->validate([
            'acount_id' => 'required',
            'description' => 'required',
            'tgl' => 'required',
            'debet' => 'required',
            'credit' => 'required',
        ]);

        Cashflow::where('id', $cashflow->id)->update($validatedData);

        if ($request->file('url')) {
            if ($request->old_url) {
                storage::delete($request->old_url);
                $cashflow->image->delete();
            }
            $valid = $request->validate(['url' => 'image|file|max:2048']);
            $valid['url'] = $request->file('url')->store('cashflow-pic');

            $cashflow->image()->create($valid);
        }

        return redirect('/cash')->with('success', 'Data Berhasil Diperbaharui');
    }
    public function destroy(Cashflow $cashflow)
    {
        $cashflow->destroy($cashflow->id);

        if ($cashflow->image) {
            storage::delete($cashflow->image->url);
            $cashflow->image->delete();
        }

        return redirect('/cash')->with('success', 'Data Berhasil Terhapus');
    }

    public function exportexcel()
    {
        return Excel::download(
            new CashflowExport(),
            'cashflow-' . Carbon::today() . '.xlsx'
        );
    }

    public function exportpdf()
    {
        $saldo2 = 0;
        $saldos = Cashflow::select('debet', 'credit')
            ->where('tgl', '<', date('Y-m-d'))
            ->get();

        foreach ($saldos as $saldo) {
            $saldo2 = $saldo2 + $saldo->credit - $saldo->debet;
        }

        $pdf = pdf::loadview('cash.pdf', [
            'datas' => Cashflow::with('acount')
                ->where('tgl', '=', date('Y-m-d'))
                ->orderBY('tgl', 'ASC')
                ->get(),
            'saldo' => $saldo2,
        ]);

        return $pdf->download('cashflow-' . Carbon::today() . '.pdf');
    }
}
