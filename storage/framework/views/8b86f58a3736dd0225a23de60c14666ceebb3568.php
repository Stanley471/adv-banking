

<?php $__env->startSection('content'); ?>
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
        <img src="<?php echo e(asset('asset/images/logo.png')); ?>" alt="<?php echo e($set->site_name); ?>" class="receipt-logo">
        <h1 class="receipt-title">Transaction Receipt</h1>
        <p class="receipt-subtitle">
            International transactions will take 2-3 days to be<br>processed and sent.
        </p>
    </div>

    <!-- Success/Failed Status Banner -->
    <?php if($transaction->status == 'failed'): ?>
        <!-- Failed Transaction Alert -->
        <div class="text-center py-6" style="background: #fee2e2; border-radius: 12px; margin: 20px 0;">
            <div class="d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background: #fecaca; border-radius: 50%;">
                <i class="fas fa-times-circle text-danger" style="font-size: 48px;"></i>
            </div>
            <h3 class="text-danger mt-4 mb-2 fw-bold">Transfer Failed!</h3>
            
            <?php if($transaction->rejection_reason && str_contains($transaction->rejection_reason, 'blocked')): ?>
                <!-- Blocked User Message -->
                <div class="alert alert-danger mx-4 mt-4 p-4" style="border-left: 4px solid #dc3545; background: white;">
                    <h4 class="fw-bold mb-3" style="color: #dc3545;">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Account Blocked
                    </h4>
                    <p class="mb-4" style="color: #2d3748;">Your account has been temporarily blocked. Please contact our support team for assistance.</p>
                    <a href="<?php echo e(route('user.ticket')); ?>" class="btn btn-danger btn-lg">
                        <i class="fas fa-headset me-2"></i>Contact Support
                    </a>
                </div>
            <?php else: ?>
                <p class="text-danger fw-bold mt-3"><?php echo e($transaction->rejection_reason ?? 'Transaction could not be completed'); ?></p>
                <p class="text-danger">Please contact support if the issue persists.</p>
                <i class=""></i>
            <?php endif; ?>
        </div>
    <?php elseif($transaction->status == 'pending'): ?>
        <!-- Pending Status -->
        <div class="text-center py-4" style="background: #fef3c7; border-radius: 12px; margin: 20px 0;">
            <div class="d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: #fcd34d; border-radius: 50%;">
                <i class="fas fa-clock text-warning" style="font-size: 32px;"></i>
            </div>
            <h4 class="text-warning mt-3 mb-1 fw-bold">Transfer Pending</h4>
            <p class="text-muted small mb-0">Your transfer is being processed</p>
        </div>
    <?php else: ?>
        <!-- Success -->
        <div class="text-center py-4" style="background: #e8f5e9; border-radius: 12px; margin: 20px 0;">
            <div class="d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: #a5d6a7; border-radius: 50%;">
                <i class="fas fa-check-circle text-success" style="font-size: 32px;"></i>
            </div>
            <h4 class="text-success mt-3 mb-1 fw-bold">Transfer Successful!</h4>
            <p class="text-muted small mb-0">Your money has been sent successfully</p>
        </div>
    <?php endif; ?>

    <!-- Sender Section -->
    <div class="receipt-section">
        <div class="receipt-section-title">SENDER</div>
        
        <div class="receipt-row">
            <span class="receipt-label">Name</span>
            <span class="receipt-value"><?php echo e($transaction->user->first_name); ?> <?php echo e($transaction->user->last_name); ?></span>
        </div>
        
        <div class="receipt-row">
            <span class="receipt-label">Account Number</span>
            <span class="receipt-value"><?php echo e('******* '.substr($transaction->user->merchant_id, -4)); ?></span>
        </div>
        
        <div class="receipt-row">
            <span class="receipt-label">Account Type</span>
            <span class="receipt-value">CHECKINGS</span>
        </div>
    </div>

    <!-- Receiver Section -->
    <div class="receipt-section">
        <div class="receipt-section-title">RECEIVER</div>
        
        <div class="receipt-row">
            <span class="receipt-label">Name</span>
            <?php if($transaction->beneficiary_id && $transaction->beneficiary): ?>
                <span class="receipt-value"><?php echo e($transaction->beneficiary->recipient->first_name); ?> <?php echo e($transaction->beneficiary->recipient->last_name); ?></span>
            <?php else: ?>
                <?php
                    $recipient = \App\Models\User::find($transaction->beneficiary_id);
                ?>
                <span class="receipt-value"><?php echo e($recipient->first_name ?? 'N/A'); ?> <?php echo e($recipient->last_name ?? ''); ?></span>
            <?php endif; ?>
        </div>
        
        <div class="receipt-row">
            <span class="receipt-label">Account Number</span>
            <?php if($transaction->beneficiary_id && $transaction->beneficiary): ?>
                <span class="receipt-value"><?php echo e('******* '.substr($transaction->beneficiary->recipient->merchant_id ?? '0000', -4)); ?></span>
            <?php else: ?>
                <span class="receipt-value"><?php echo e('******* '.substr($recipient->merchant_id ?? '0000', -4)); ?></span>
            <?php endif; ?>
        </div>
        
        <div class="receipt-row">
            <span class="receipt-label">Amount</span>
            <span class="receipt-value receipt-amount"><?php echo e($transaction->user->getFirstBalance()->getCurrency->currency_symbol); ?> <?php echo e(number_format($transaction->amount, 2)); ?></span>
        </div>
    </div>

    <!-- Receiver Bank Details -->
    <div class="receipt-section">
        <div class="receipt-section-title">RECEIVER BANK DETAILS</div>
        
        <div class="receipt-row">
            <span class="receipt-label">Bank</span>
            <span class="receipt-value"><?php echo e($set->site_name); ?></span>
        </div>
        
        <div class="receipt-row">
            <span class="receipt-label">Address</span>
            <span class="receipt-value"><?php echo e($set->address); ?></span>
        </div>
        
        <div class="receipt-row">
            <span class="receipt-label">Routing</span>
            <span class="receipt-value">Internal Transfer</span>
        </div>
    </div>

    <!-- Transaction Details -->
    <div class="receipt-section">
        <div class="receipt-section-title">TRANSACTION DETAILS</div>
        
        <div class="receipt-row">
            <span class="receipt-label">Transaction ID</span>
            <span class="receipt-value"><?php echo e($transaction->ref_id); ?></span>
        </div>
        
        <div class="receipt-row">
            <span class="receipt-label">Date & Time</span>
            <span class="receipt-value"><?php echo e($transaction->created_at->format('M d, Y h:i A')); ?></span>
        </div>
        
        <div class="receipt-row">
            <span class="receipt-label">Status</span>
            <span class="receipt-value" style="color: 
                <?php if($transaction->status == 'success'): ?> #48bb78
                <?php elseif($transaction->status == 'pending'): ?> #f59e0b
                <?php else: ?> #ef4444 <?php endif; ?>;">
                <?php echo e(strtoupper($transaction->status)); ?>

            </span>
        </div>

        <!-- Show rejection reason if failed -->
        <?php if($transaction->status == 'failed' && $transaction->rejection_reason): ?>
        <div class="receipt-row">
            <span class="receipt-label">Reason</span>
            <span class="receipt-value" style="color: #ef4444; font-size: 12px;"><?php echo e($transaction->rejection_reason); ?></span>
        </div>
        <?php endif; ?>
        
        <?php if($transaction->charge > 0): ?>
        <div class="receipt-row">
            <span class="receipt-label">Transaction Fee</span>
            <span class="receipt-value"><?php echo e($transaction->user->getFirstBalance()->getCurrency->currency_symbol); ?> <?php echo e(number_format($transaction->charge, 2)); ?></span>
        </div>
        <?php endif; ?>
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
                <a href="<?php echo e(route('user.dashboard')); ?>" class="btn btn-lg w-100" style="background: #556B2F; color: white;">
                    <i class="fas fa-home me-2"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/user/transaction-receipt.blade.php ENDPATH**/ ?>