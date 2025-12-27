 

<?php $__env->startSection('content'); ?>
<div class="container py-10">
    <div class="d-flex justify-content-between align-items-center mb-8">
        <h1 class="text-dark fw-bold">Pending External Transfers</h1>
        <span class="badge badge-warning fs-5"><?php echo e($transactions->total()); ?> Pending</span>
    </div>
    
    <?php if($transactions->count() > 0): ?>
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
                        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $details = json_decode($transaction->details, true);
                        ?>
                        <tr>
                            <td>
                                <span class="text-dark fw-bold"><?php echo e($transaction->created_at->format('M d, Y')); ?></span><br>
                                <span class="text-muted small"><?php echo e($transaction->created_at->format('h:i A')); ?></span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40px me-3">
                                        <div class="symbol-label bg-light-primary text-primary fw-bold">
                                            <?php echo e(substr($transaction->user->first_name, 0, 1)); ?>

                                        </div>
                                    </div>
                                    <div>
                                        <span class="text-dark fw-bold d-block"><?php echo e($transaction->user->first_name); ?> <?php echo e($transaction->user->last_name); ?></span>
                                        <span class="text-muted small"><?php echo e($transaction->user->email); ?></span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-dark fw-bold fs-5"><?php echo e($transaction->user->getFirstBalance()->getCurrency->currency_symbol); ?><?php echo e(number_format($transaction->amount, 2)); ?></span><br>
                                <?php if($transaction->charge > 0): ?>
                                <span class="text-muted small">Fee: <?php echo e($transaction->user->getFirstBalance()->getCurrency->currency_symbol); ?><?php echo e(number_format($transaction->charge, 2)); ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="small">
                                    <strong>Bank:</strong> <?php echo e($details['bank_name'] ?? 'N/A'); ?><br>
                                    <strong>Routing:</strong> <?php echo e($details['routing_number'] ?? 'N/A'); ?><br>
                                    <strong>Account:</strong> ****<?php echo e($details['account_number'] ?? 'N/A'); ?><br>
                                    <strong>Name:</strong> <?php echo e($details['account_holder_name'] ?? 'N/A'); ?><br>
                                    <strong>Type:</strong> <?php echo e(ucfirst($details['account_type'] ?? 'N/A')); ?>

                                </div>
                            </td>
                            <td>
                                <span class="badge badge-warning">PENDING</span>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#approve<?php echo e($transaction->id); ?>">
                                    <i class="fas fa-check"></i> Approve
                                </button>
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#reject<?php echo e($transaction->id); ?>">
                                    <i class="fas fa-times"></i> Reject
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Approve Modal -->
                        <div class="modal fade" id="approve<?php echo e($transaction->id); ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-success">
                                        <h5 class="modal-title text-white">Approve Transaction</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="<?php echo e(route('admin.transactions.approve', $transaction->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-body">
                                            <p class="mb-4">Are you sure you want to approve this external transfer?</p>
                                            <div class="alert alert-info">
                                                <strong>Amount:</strong> <?php echo e($transaction->user->getFirstBalance()->getCurrency->currency_symbol); ?><?php echo e(number_format($transaction->amount, 2)); ?><br>
                                                <strong>To:</strong> <?php echo e($details['account_holder_name'] ?? 'N/A'); ?><br>
                                                <strong>Bank:</strong> <?php echo e($details['bank_name'] ?? 'N/A'); ?>

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
                        <div class="modal fade" id="reject<?php echo e($transaction->id); ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h5 class="modal-title text-white">Reject Transaction</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="<?php echo e(route('admin.transactions.reject', $transaction->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-body">
                                            <p class="mb-4">Reject this transaction? The funds will be refunded to the user.</p>
                                            <div class="alert alert-warning">
                                                <strong>Refund Amount:</strong> <?php echo e($transaction->user->getFirstBalance()->getCurrency->currency_symbol); ?><?php echo e(number_format($transaction->amount + $transaction->charge, 2)); ?>

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
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="mt-5">
        <?php echo e($transactions->links()); ?>

    </div>
    
    <?php else: ?>
    <div class="text-center py-20">
        <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>
        <h3 class="mt-5">No Pending Transactions</h3>
        <p class="text-muted">All external transfers have been processed</p>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/admin/transactions/pending.blade.php ENDPATH**/ ?>