<?php

namespace App\Http\Controllers;

use App\Models\acount;
use App\Models\Cashflow;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
            'datas' => Cashflow::with('acount')
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
            $request->acount_id . $request->tgl,
            '-'
        );

        Cashflow::create($validatedData);

        return redirect('/cash')->with('success', 'data Telah Tersimpan');
    }

    public function edit(Cashflow $cashflow)
    {
        return view('cash.edit', [
            'title' => 'Edit Transaction',
            'acount' => acount::all(),
            'data' => $cashflow,
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

        return redirect('/cash')->with('success', 'Data Berhasil Diperbaharui');
    }
    public function destroy(Cashflow $cashflow)
    {
        $cashflow->destroy($cashflow->id);

        return redirect('/cash')->with('success', 'Data Berhasil Terhapus');
    }
}
