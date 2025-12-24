<?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr class="cursor-pointer" onclick="window.location='<?php echo e(route('transaction.receipt', $val->id)); ?>'" style="transition: background 0.2s;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='transparent'">
    <td>
        <div class="symbol symbol-40px symbol-circle me-5">
            <div class="symbol-label fs-3 fw-bolder text-info bg-light-info">
                <?php if($val->trx_type == 'debit'): ?>
                <i class="fal fa-minus"></i>
                <?php else: ?>
                <i class="fal fa-plus"></i>
                <?php endif; ?>
            </div>
        </div>
    </td>
    <td><?php echo e($currency->currency_symbol.currencyFormat(number_format($val->amount, 2)).' '.$currency->currency); ?></td>
    <td><?php echo e(ucwords(str_replace('_', ' ', $val->type))); ?></td>
    <td>
        <?php if($val->status == 'success'): ?>
        <span class="badge badge-pill badge-success badge-sm"><?php echo e(__('Success')); ?></span>
        <?php elseif($val->status == 'pending'): ?>
        <span class="badge badge-pill badge-info badge-sm"><?php echo e(__('Pending')); ?></span>
        <?php elseif($val->status == 'failed'): ?>
        <span class="badge badge-pill badge-danger badge-sm"><?php echo e(__('Failed')); ?></span>
        <?php elseif($val->status == 'cancelled'): ?>
        <span class="badge badge-pill badge-danger badge-sm"><?php echo e(__('Cancelled')); ?></span>
        <?php endif; ?>
    </td>
    <?php if($all == 1): ?><td><?php echo e($val->ref_id); ?></td> <?php endif; ?>
    <td><?php echo e($val->created_at->toDayDateTimeString()); ?></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/partials/transfer/table.blade.php ENDPATH**/ ?>