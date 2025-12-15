<?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div wire:ignore.self id="kt_trx_<?php echo e($val->id); ?>" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_trx_<?php echo e($val->id); ?>_button" data-kt-drawer-close="#kt_trx_<?php echo e($val->id); ?>_close">
    <div class="card w-100">
        <div class="card-header pe-5 border-0">
            <div class="card-title">
                <div class="d-flex justify-content-center flex-column me-3">
                    <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1"><?php echo e(__('Transaction Details')); ?></div>
                </div>
            </div>
            <div class="card-toolbar">
                <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_trx_<?php echo e($val->id); ?>_close">
                    <span class="svg-icon svg-icon-2">
                        <i class="fal fa-times"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body text-wrap">
            <div class="btn-wrapper text-center mb-3">
                <div class="symbol symbol-100px symbol-circle me-5 mb-10">
                    <div class="symbol-label fs-1 text-info bg-light-info">
                        <?php if($val->trx_type == 'debit'): ?>
                        <i class="fal fa-minus fa-2x"></i>
                        <?php else: ?>
                        <i class="fal fa-plus fa-2x"></i>
                        <?php endif; ?>
                    </div>
                </div>
                <p class="text-dark fs-1 fw-bolder"><?php echo e($currency->currency_symbol.currencyFormat(number_format($val->amount, 2)).' '.$currency->currency); ?></p>
            </div>
            <div class="d-flex flex-column">
                <li class="d-flex align-items-center py-2">
                    <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Reference')); ?>: <?php echo e($val->ref_id); ?> <i class="fal fa-clone castro-copy fs-5" data-clipboard-text="<?php echo e($val->ref_id); ?>" title="Copy"></i></span>
                </li>
                <li class="d-flex align-items-center py-2">
                    <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Charge')); ?>: <?php echo e($currency->currency_symbol.currencyFormat(number_format($val->charge, 2)).' '.$currency->currency); ?></span>
                </li>
                <li class="d-flex align-items-center py-2">
                    <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Date')); ?>: <?php echo e($val->created_at->toDayDateTimeString()); ?></span>
                </li>
                <li class="d-flex align-items-center py-2">
                    <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Type')); ?>: <?php echo e(ucwords(str_replace('_', ' ', $val->type))); ?></span>
                </li>
                <?php if($val->type == 'deposit'): ?>
                <li class="d-flex align-items-center py-2">
                    <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Method')); ?>: <?php echo e($val?->gateway?->name); ?></span>
                </li>
                <?php elseif($val->type == 'bank_transfer'): ?>
                <li class="d-flex align-items-center py-2">
                    <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Bank Reference')); ?>: <?php echo e($val->bank_reference); ?></span>
                </li>
                <?php elseif($val->type == 'payout'): ?>
                <?php if($val->acct_id != null): ?>
                <li class="d-flex align-items-center py-2">
                    <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Bank')); ?>: <?php echo e($val?->acct?->bank?->title); ?></span>
                </li>
                <li class="d-flex align-items-center py-2">
                    <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Account Number')); ?>: ******* <?php echo e(substr($val?->acct?->acct_no, -4)); ?></span>
                </li>
                <li class="d-flex align-items-center py-2">
                    <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Account Name')); ?>: <?php echo e($val?->acct?->acct_name); ?></span>
                </li>
                <?php else: ?>
                <li class="d-flex align-items-center py-2">
                    <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Payout Method')); ?>: <?php echo e($val?->withdrawMethod?->name); ?></span>
                </li>
                <li class="d-flex align-items-center py-2">
                    <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Details')); ?>: <?php echo e($val->details); ?></span>
                </li>
                <?php endif; ?>
                <?php elseif($val->type == 'investment_fee'): ?>
                <li class="d-flex align-items-center py-2">
                    <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Name')); ?>: <?php echo e($val?->followed?->plan?->name); ?></span>
                </li>
                <?php elseif($val->type == 'loan_payment'): ?>
                <li class="d-flex align-items-center py-2">
                    <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Name')); ?>: <?php echo e($val->installment?->plan?->name); ?></span>
                </li>
                <li class="d-flex align-items-center py-2">
                    <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Application Reference')); ?>: <?php echo e($val->installment?->application?->ref_id); ?></span>
                </li>
                <li class="d-flex align-items-center py-2">
                    <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Installment Reference')); ?>: <?php echo e($val->installment?->ref_id); ?></span>
                </li>
                <?php elseif($val->type == 'investment_returns'): ?>
                <li class="d-flex align-items-center py-2">
                    <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Name')); ?>: <?php echo e($val?->followed?->plan?->name); ?></span>
                </li>
                <?php elseif($val->type == 'savings_deposit' || $val->type == 'savings_withdraw' || $val->type == 'savings_return'): ?>
                <li class="d-flex align-items-center py-2">
                    <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Name')); ?>: <?php echo e(($val?->savings?->type == 'circle') ? $val?->savings?->circle?->name : $val?->savings?->name); ?></span>
                </li>
                <?php if($val->savings->type == 'duo'): ?>
                <li class="d-flex align-items-center py-2">
                    <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('By')); ?>: <?php echo e($val?->user?->business?->name); ?></span>
                </li>
                <?php endif; ?>
                <?php elseif($val->type == 'debit_transfer'): ?>
                <li class="d-flex align-items-center py-2">
                    <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Recipient')); ?>: <?php echo e($val?->beneficiary?->recipient?->business?->name); ?></span>
                </li>
                <?php elseif($val->type == 'credit_transfer'): ?>
                <li class="d-flex align-items-center py-2">
                    <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Sender')); ?>: <?php echo e($val?->sender?->business?->name); ?></span>
                </li>
                <?php elseif($val->type == 'unit_purchase' || $val->type == 'unit_sale' || $val->type == 'dividend_return'): ?>
                <li class="d-flex align-items-center py-2">
                    <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Name')); ?>: <?php echo e($val?->units?->plan?->name); ?></span>
                </li>
                <li class="d-flex align-items-center py-2">
                    <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Units')); ?>: <?php echo e($val?->units?->units); ?></span>
                </li>
                <?php endif; ?>
                <li class="d-flex align-items-center py-2">
                    <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Status')); ?>:
                        <?php if($val->status == 'success'): ?>
                        <span class="badge badge-pill badge-success badge-sm"><?php echo e(__('Success')); ?></span>
                        <?php elseif($val->status == 'pending'): ?>
                        <span class="badge badge-pill badge-info badge-sm"><?php echo e(__('Pending')); ?></span>
                        <?php elseif($val->status == 'failed'): ?>
                        <span class="badge badge-pill badge-danger badge-sm"><?php echo e(__('Failed')); ?></span>
                        <?php elseif($val->status == 'cancelled'): ?>
                        <span class="badge badge-pill badge-danger badge-sm"><?php echo e(__('Cancelled')); ?></span>
                        <?php endif; ?>
                    </span>
                </li>

            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/partials/transfer/details.blade.php ENDPATH**/ ?>