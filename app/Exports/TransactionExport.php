<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class TransactionExport implements FromQuery, WithMapping, WithHeadings
{
    protected $transactions;

    public function __construct($transactions)
    {
        $this->transactions = $transactions;
    }
    /**
     * @return \Illuminate\Support\Collection
     */

    public function map($transactions): array
    {
        return [
            $transactions->ref_id,
            $transactions->trx_type,
            $transactions->type,
            currencyFormat(number_format($transactions->amount, 2)) . ' USD',
            currencyFormat(number_format($transactions->charge, 2)) . ' USD',
            ucwords($transactions->status),
            $transactions->created_at->toDayDateTimeString()
        ];
    }

    public function headings(): array
    {
        return ['Reference', 'Type', 'Description', 'Amount', 'Fees', 'Status', 'Date'];
    }

    public function query()
    {
        return $this->transactions;
    }
}
