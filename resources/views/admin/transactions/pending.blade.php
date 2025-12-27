@extends('admin.menu') {{-- or whatever your admin layout is --}}

@section('content')
<div class="container py-10">
    <div class="d-flex justify-content-between align-items-center mb-8">
        <h1 class="text-dark fw-bold">Pending External Transfers</h1>
        <span class="badge badge-warning fs-5">{{$transactions->total()}} Pending</span>
    </div>
    
    @if($transactions->count() > 0)
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-row-bordered align-middle">
                    <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th>Date</th>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Bank Details</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                        @php
                            $details = json_decode($transaction->details, true);
                        @endphp
                        <tr>
                            <td>
                                <span class="text-dark fw-bold">{{$transaction->created_at->format('M d, Y')}}</span><br>
                                <span class="text-muted small">{{$transaction->created_at->format('h:i A')}}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40px me-3">
                                        <div class="symbol-label bg-light-primary text-primary fw-bold">
                                            {{substr($transaction->user->first_name, 0, 1)}}
                                        </div>
                                    </div>
                                    <div>
                                        <span class="text-dark fw-bold d-block">{{$transaction->user->first_name}} {{$transaction->user->last_name}}</span>
                                        <span class="text-muted small">{{$transaction->user->email}}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-dark fw-bold fs-5">{{$transaction->user->getFirstBalance()->getCurrency->currency_symbol}}{{number_format($transaction->amount, 2)}}</span><br>
                                @if($transaction->charge > 0)
                                <span class="text-muted small">Fee: {{$transaction->user->getFirstBalance()->getCurrency->currency_symbol}}{{number_format($transaction->charge, 2)}}</span>
                                @endif
                            </td>
                            <td>
                                <div class="small">
                                    <strong>Bank:</strong> {{$details['bank_name'] ?? 'N/A'}}<br>
                                    <strong>Routing:</strong> {{$details['routing_number'] ?? 'N/A'}}<br>
                                    <strong>Account:</strong> ****{{$details['account_number'] ?? 'N/A'}}<br>
                                    <strong>Name:</strong> {{$details['account_holder_name'] ?? 'N/A'}}<br>
                                    <strong>Type:</strong> {{ucfirst($details['account_type'] ?? 'N/A')}}
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-warning">PENDING</span>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#approve{{$transaction->id}}">
                                    <i class="fas fa-check"></i> Approve
                                </button>
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#reject{{$transaction->id}}">
                                    <i class="fas fa-times"></i> Reject
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Approve Modal -->
                        <div class="modal fade" id="approve{{$transaction->id}}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-success">
                                        <h5 class="modal-title text-white">Approve Transaction</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="{{route('admin.transactions.approve', $transaction->id)}}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <p class="mb-4">Are you sure you want to approve this external transfer?</p>
                                            <div class="alert alert-info">
                                                <strong>Amount:</strong> {{$transaction->user->getFirstBalance()->getCurrency->currency_symbol}}{{number_format($transaction->amount, 2)}}<br>
                                                <strong>To:</strong> {{$details['account_holder_name'] ?? 'N/A'}}<br>
                                                <strong>Bank:</strong> {{$details['bank_name'] ?? 'N/A'}}
                                            </div>
                                            <p class="text-muted small">Make sure you have initiated the actual wire transfer before approving.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-check"></i> Confirm Approval
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Reject Modal -->
                        <div class="modal fade" id="reject{{$transaction->id}}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h5 class="modal-title text-white">Reject Transaction</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="{{route('admin.transactions.reject', $transaction->id)}}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <p class="mb-4">Reject this transaction? The funds will be refunded to the user.</p>
                                            <div class="alert alert-warning">
                                                <strong>Refund Amount:</strong> {{$transaction->user->getFirstBalance()->getCurrency->currency_symbol}}{{number_format($transaction->amount + $transaction->charge, 2)}}
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Reason for Rejection</label>
                                                <textarea name="reason" class="form-control" rows="3" required placeholder="Enter reason..."></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-times"></i> Reject & Refund
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="mt-5">
        {{$transactions->links()}}
    </div>
    
    @else
    <div class="text-center py-20">
        <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>
        <h3 class="mt-5">No Pending Transactions</h3>
        <p class="text-muted">All external transfers have been processed</p>
    </div>
    @endif
</div>
@endsection