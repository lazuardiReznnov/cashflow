<?php

namespace App\Exports;

use App\Models\Cashflow;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
<<<<<<< HEAD

class CashflowExport implements FromView
=======
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class CashflowExport implements FromView, ShouldAutoSize, WithEvents
>>>>>>> e54706a108f581e68b5e9b35875b6ddfe2d7d9ae
{
    public function view(): View
    {
        $saldo2 = 0;
        $saldos = Cashflow::select('debet', 'credit')
            ->where('tgl', '<', date('Y-m-d'))
            ->get();

        foreach ($saldos as $saldo) {
            $saldo2 = $saldo2 + $saldo->credit - $saldo->debet;
        }
<<<<<<< HEAD
        return view('cash.export', [
            'saldo' => $saldo2,
=======
        return view('cash.excel', [
>>>>>>> e54706a108f581e68b5e9b35875b6ddfe2d7d9ae
            'datas' => Cashflow::with('acount')
                ->where('tgl', '=', date('Y-m-d'))
                ->orderBY('tgl', 'ASC')
                ->get(),
<<<<<<< HEAD
        ]);
=======
            'saldo' => $saldo2,
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A3:W3'; // All headers
                $event->sheet
                    ->getDelegate()
                    ->getStyle($cellRange)
                    ->getFont()
                    ->setSize(14);
            },
        ];
>>>>>>> e54706a108f581e68b5e9b35875b6ddfe2d7d9ae
    }
}
