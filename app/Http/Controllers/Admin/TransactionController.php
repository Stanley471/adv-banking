<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transactions;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function pending()
    {
        $transactions = Transactions::with(['user.business'])
            ->where('status', 'pending')
            ->where('type', 'external_wire_transfer')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        $title = 'Pending Transactions';
        
        return view('admin.transactions.pending', compact('transactions', 'title'));
    }
    
    public function approve($id)
    {
        $transaction = Transactions::findOrFail($id);
        
        // Update status to success
        $transaction->update([
            'status' => 'success',
            'processed_at' => now(),
            'processed_by' => auth()->id(),
        ]);
        
        // Create audit trail
        createAudit('External transfer approved - ' . $transaction->ref_id, auth()->user());
        
        // Send email to user
        dispatch(new \App\Jobs\CustomEmail('external_transfer_approved', $transaction->id));
        
        return redirect()->back()->with('success', 'Transaction approved successfully');
    }
    
    public function reject(Request $request, $id)
    {
        $transaction = Transactions::findOrFail($id);
        
        // Refund the money back to user
        $user = $transaction->user;
        $balance = $user->getFirstBalance();
        $refundAmount = $transaction->amount + $transaction->charge;
        
        $balance->update([
            'amount' => $balance->amount + $refundAmount
        ]);
        
        // Update transaction status
        $transaction->update([
            'status' => 'failed',
            'rejection_reason' => $request->reason,
            'processed_at' => now(),
            'processed_by' => auth()->id(),
        ]);
        
        // Create audit trail
        createAudit('External transfer rejected - ' . $transaction->ref_id . ' - Reason: ' . $request->reason, auth()->user());
        
        // Send email to user
        dispatch(new \App\Jobs\CustomEmail('external_transfer_rejected', $transaction->id));
        
        return redirect()->back()->with('success', 'Transaction rejected and funds refunded');
    }
}