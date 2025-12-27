@extends('user.menu')

@section('content')
<style>
.receipt-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background: white;
    min-height: 100vh;
    font-family: 'Courier New', Courier, monospace;
}

.receipt-header {
    text-align: center;
    padding: 30px 20px;
    background: white;
}

.receipt-logo {
    width: 80px;
    height: auto;
    margin-bottom: 15px;
    opacity: 0.7;
}

.receipt-title {
    font-size: 22px;
    font-weight: 700;
    color: #2d3748;
    margin: 0;
    font-family: 'Courier New', Courier, monospace;
}

.receipt-subtitle {
    font-size: 12px;
    color: #718096;
    margin-top: 20px;
    line-height: 1.6;
}

.receipt-section {
    background: #f7fafc;
    padding: 20px;
    margin-bottom: 15px;
    border-radius: 8px;
}

.receipt-section-title {
    font-size: 14px;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 15px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.receipt-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #e2e8f0;
}

.receipt-row:last-child {
    border-bottom: none;
}

.receipt-label {
    font-size: 12px;
    color: #718096;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.receipt-value {
    font-size: 14px;
    font-weight: 600;
    color: #2d3748;
    text-align: right;
}

.receipt-amount {
    font-size: 28px;
    font-weight: 700;
    color: #2d3748;
}

.download-btn {
    position: fixed;
    top: 80px;
    right: 20px;
    background: white;
    border: 2px solid #2d3748;
    border-radius: 20px;
    padding: 8px 20px;
    font-size: 14px;
    font-weight: 600;
    color: #2d3748;
    cursor: pointer;
    z-index: 100;
}

.progress-bar {
    position: fixed;
    top: 70px;
    left: 20px;
    right: 140px;
    height: 35px;
    background: #48bb78;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 14px;
    z-index: 100;
}

@media print {
    .download-btn, .progress-bar, .header, .aside, #kt_header, .bottom-nav, .btn {
        display: none !important;
    }
}

@media (max-width: 768px) {
    .receipt-container {
        padding: 10px;
    }
    
    .download-btn {
        top: 70px;
        right: 10px;
        padding: 6px 15px;
        font-size: 12px;
    }
    
    .progress-bar {
        left: 10px;
        right: 120px;
        top: 60px;
    }
}
</style>

<div class="progress-bar d-lg-none">
    100%
</div>
<button class="download-btn d-lg-none" onclick="window.print()">
    DOWNLOAD <i class="fas fa-download"></i>
</button>

<div class="receipt-container">
    <!-- Header -->
    <div class="receipt-header">
        <img src="{{asset('asset/images/logo.png')}}" alt="{{$set->site_name}}" class="receipt-logo">
        <h1 class="receipt-title">Transaction Receipt</h1>
        <p class="receipt-subtitle">
            International transactions will take 2-3 days to be<br>processed and sent.
        </p>
    </div>

    <!-- Sender Section -->
    <div class="receipt-section">
        <div class="receipt-section-title">SENDER</div>
        
        <div class="receipt-row">
            <span class="receipt-label">Name</span>
            <span class="receipt-value">{{$transaction->user->first_name}} {{$transaction->user->last_name}}</span>
        </div>
        
        <div class="receipt-row">
            <span class="receipt-label">Account Number</span>
            <span class="receipt-value">{{'******* '.substr($transaction->user->merchant_id, -4)}}</span>
        </div>
        
        <div class="receipt-row">
            <span class="receipt-label">Account Type</span>
            <span class="receipt-value">CHECKINGS</span>
        </div>
    </div>

    <!-- Receiver Section -->
    <!-- Receiver Section -->
<div class="receipt-section">
    <div class="receipt-section-title">RECEIVER</div>
    
    <div class="receipt-row">
        <span class="receipt-label">Name</span>
        @if($transaction->beneficiary_id && $transaction->beneficiary)
            <span class="receipt-value">{{$transaction->beneficiary->recipient->first_name}} {{$transaction->beneficiary->recipient->last_name}}</span>
        @else
            @php
                $recipient = \App\Models\User::find($transaction->beneficiary_id);
            @endphp
            <span class="receipt-value">{{$recipient->first_name ?? 'N/A'}} {{$recipient->last_name ?? ''}}</span>
        @endif
    </div>
    
    <div class="receipt-row">
        <span class="receipt-label">Account Number</span>
        @if($transaction->beneficiary_id && $transaction->beneficiary)
            <span class="receipt-value">{{'******* '.substr($transaction->beneficiary->recipient->merchant_id ?? '0000', -4)}}</span>
        @else
            <span class="receipt-value">{{'******* '.substr($recipient->merchant_id ?? '0000', -4)}}</span>
        @endif
    </div>
    
    <div class="receipt-row">
        <span class="receipt-label">Amount</span>
        <span class="receipt-value receipt-amount">{{$transaction->user->getFirstBalance()->getCurrency->currency_symbol}} {{number_format($transaction->amount, 2)}}</span>
    </div>
</div>

    <!-- Receiver Bank Details -->
    @if($transaction->beneficiary && $transaction->beneficiary->recipient)
    <div class="receipt-section">
        <div class="receipt-section-title">RECEIVER BANK DETAILS</div>
        
        <div class="receipt-row">
            <span class="receipt-label">Bank</span>
            <span class="receipt-value">{{$transaction->beneficiary->bank_name ?? 'N/A'}}</span>
        </div>
        
        <div class="receipt-row">
            <span class="receipt-label">Address</span>
            <span class="receipt-value">{{$transaction->beneficiary->bank_address ?? 'N/A'}}</span>
        </div>
        
        <div class="receipt-row">
            <span class="receipt-label">Routing</span>
            <span class="receipt-value">{{$transaction->beneficiary->routing ?? 'N/A'}}</span>
        </div>
    </div>
    @endif

    <!-- Transaction Details -->
    <div class="receipt-section">
        <div class="receipt-section-title">TRANSACTION DETAILS</div>
        
        <div class="receipt-row">
            <span class="receipt-label">Transaction ID</span>
            <span class="receipt-value">{{$transaction->ref_id}}</span>
        </div>
        
        <div class="receipt-row">
            <span class="receipt-label">Date & Time</span>
            <span class="receipt-value">{{$transaction->created_at->format('M d, Y h:i A')}}</span>
        </div>
        
        <div class="receipt-row">
            <span class="receipt-label">Status</span>
            <span class="receipt-value" style="color: #48bb78;">{{strtoupper($transaction->status)}}</span>
        </div>
        
        @if($transaction->charge > 0)
        <div class="receipt-row">
            <span class="receipt-label">Transaction Fee</span>
            <span class="receipt-value">{{$transaction->user->getFirstBalance()->getCurrency->currency_symbol}} {{number_format($transaction->charge, 2)}}</span>
        </div>
        @endif
    </div>

    <!-- Desktop Buttons -->
    <div class="d-none d-lg-block mt-5">
        <div class="row g-3">
            <div class="col-md-6">
                <button onclick="window.print()" class="btn btn-outline-secondary btn-lg w-100">
                    <i class="fas fa-print me-2"></i> Print Receipt
                </button>
            </div>
            <div class="col-md-6">
                <a href="{{route('user.dashboard')}}" class="btn btn-lg w-100" style="background: #556B2F; color: white;">
                    <i class="fas fa-home me-2"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection