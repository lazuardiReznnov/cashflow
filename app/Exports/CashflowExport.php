<?php

namespace App\Exports;

use App\Models\Cashflow;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class CashflowExport implements FromView, ShouldAutoSize, WithEvents
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
        return view('cash.excel', [
            'datas' => Cashflow::with('acount')
                ->where('tgl', '=', date('Y-m-d'))
                ->orderBY('tgl', 'ASC')
                ->get(),
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
    }
}
