<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transactions;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function receipt($id)
    {
        $transaction = Transactions::with(['user.business', 'beneficiary.recipient.business', 'sender.business'])
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
        
        $title = 'Transaction Receipt';
        $user = auth()->user();
        $set = \App\Models\Settings::first();

        
        return view('user.transaction-receipt', compact('transaction', 'title', 'user', 'set'));
    }
}