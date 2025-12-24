@extends('user.menu')

@section('content')
<div class="container py-10">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <!-- Receipt Card -->
            <div class="card shadow-lg" id="receipt-card">
                <div class="card-body p-0">
                    <!-- Header with Logo -->
                    <div class="text-center py-8" style="background: linear-gradient(135deg, #556B2F 0%, #6B8E23 100%);">
                        <img src="{{asset('asset/images/logo.png')}}" alt="{{$set->site_name}}" style="height: 60px; filter: brightness(0) invert(1);">
                        <h2 class="text-white mt-4 mb-0">Transaction Receipt</h2>
                    </div>

                    <!-- Success Badge -->
                    <div class="text-center py-6">
                        <div class="d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background: #e8f5e9; border-radius: 50%;">
                            <i class="fas fa-check-circle text-success" style="font-size: 48px;"></i>
                        </div>
                        <h3 class="text-success mt-4 mb-2">Transfer Successful!</h3>
                        <p class="text-muted">Your money has been sent successfully</p>
                    </div>

                    <!-- Transaction Details -->
                    <div class="px-8 pb-8">
                        <!-- Amount -->
                        <div class="text-center mb-8 p-6" style="background: #f8f9fa; border-radius: 12px;">
                            <p class="text-muted mb-2">Amount Sent</p>
                            <h1 class="mb-0" style="color: #556B2F; font-size: 42px; font-weight: 700;">
                                {{$transaction->user->getFirstBalance()->getCurrency->currency_symbol}}{{number_format($transaction->amount, 2)}}
                            </h1>
                        </div>

                        <!-- Details Grid -->
                        <div class="row g-4 mb-6">
                            <div class="col-6">
                                <p class="text-muted mb-1 small">Transaction ID</p>
                                <p class="fw-bold mb-0">{{$transaction->ref_id}}</p>
                            </div>
                            <div class="col-6">
                                <p class="text-muted mb-1 small">Date & Time</p>
                                <p class="fw-bold mb-0">{{$transaction->created_at->format('M d, Y h:i A')}}</p>
                            </div>
                            <div class="col-6">
                                <p class="text-muted mb-1 small">Transaction Type</p>
                                <p class="fw-bold mb-0">{{ucwords(str_replace('_', ' ', $transaction->type))}}</p>
                            </div>
                            <div class="col-6">
                                <p class="text-muted mb-1 small">Status</p>
                                <span class="badge bg-success">{{ucfirst($transaction->status)}}</span>
                            </div>
                        </div>

                        <hr class="my-6">

                        <!-- Sender & Recipient -->
                        <div class="row g-4 mb-6">
                            <div class="col-md-6">
                                <div class="p-4" style="background: #f8f9fa; border-radius: 12px;">
                                    <p class="text-muted mb-2 small">From</p>
                                    <p class="fw-bold mb-1">{{$transaction->user->business->name}}</p>
                                    <p class="text-muted small mb-0">{{'@'.$transaction->user->merchant_id}}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-4" style="background: #f8f9fa; border-radius: 12px;">
                                    <p class="text-muted mb-2 small">To</p>
                                    <p class="fw-bold mb-1">{{$transaction->beneficiary->recipient->business->name ?? 'N/A'}}</p>
                                    <p class="text-muted small mb-0">{{'@'.($transaction->beneficiary->recipient->merchant_id ?? 'N/A')}}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Fee Breakdown -->
                        @if($transaction->charge > 0)
                        <div class="p-4 mb-6" style="background: #fff3cd; border-radius: 12px; border-left: 4px solid #ffc107;">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal</span>
                                <span class="fw-bold">{{$transaction->user->getFirstBalance()->getCurrency->currency_symbol}}{{number_format($transaction->amount, 2)}}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Transaction Fee</span>
                                <span class="fw-bold">{{$transaction->user->getFirstBalance()->getCurrency->currency_symbol}}{{number_format($transaction->charge, 2)}}</span>
                            </div>
                            <hr class="my-2">
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Total Deducted</span>
                                <span class="fw-bold" style="color: #556B2F;">{{$transaction->user->getFirstBalance()->getCurrency->currency_symbol}}{{number_format($transaction->amount + $transaction->charge, 2)}}</span>
                            </div>
                        </div>
                        @endif

                        <!-- Action Buttons -->
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

                    <!-- Footer -->
                    <div class="text-center py-4" style="background: #f8f9fa; border-top: 1px solid #dee2e6;">
                        <p class="text-muted small mb-0">Thank you for using {{$set->site_name}}</p>
                        <p class="text-muted small mb-0">For support, contact us at {{$set->site_email}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .header, .footer, .aside, #kt_header, #kt_footer, .btn, .bottom-nav {
        display: none !important;
    }
    .card {
        box-shadow: none !important;
        border: 1px solid #ddd;
    }
}
</style>
@endsection