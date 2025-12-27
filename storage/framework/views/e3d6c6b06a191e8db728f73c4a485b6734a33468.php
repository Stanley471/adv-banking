<div>
    <div wire:ignore.self id="kt_filter" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_filter_button" data-kt-drawer-close="#kt_filter_close" data-kt-drawer-width="{'md': '500px'}">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1"><?php echo e(__('Filter')); ?></div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_filter_close">
                        <span class="svg-icon svg-icon-2">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body text-wrap">
                <div class="fv-row mb-6">
                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Date Range')); ?></label>
                    <input class="form-control form-control-lg form-control-solid" placeholder="<?php echo e(__('Pick date rage')); ?>" value="<?php echo e($first.' - '.$last); ?>" name="date" id="range" onchange="this.dispatchEvent(new InputEvent('input'))" wire:model="date">
                </div>
                <div class="fv-row mb-6">
                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Type')); ?></label>
                    <select class="form-select form-select-solid" wire:model="base">
                        <option value=""><?php echo e(__('Select type')); ?></option>
                        <option value="bank_transfer"><?php echo e(__('Bank Transfer')); ?></option>
                        <option value="investment_fee"><?php echo e(__('Investment Fee')); ?></option>
                        <option value="investment_returns"><?php echo e(__('Investment Returns')); ?></option>
                        <option value="debit_transfer"><?php echo e(__('Debit Transfer')); ?></option>
                        <option value="credit_transfer"><?php echo e(__('Credit Transfer')); ?></option>
                        <option value="unit_purchase"><?php echo e(__('Unit Purchase')); ?></option>
                        <option value="unit_sale"><?php echo e(__('Unit Sale')); ?></option>
                        <option value="loan_payment"><?php echo e(__('Loan Payment')); ?></option>
                        <option value="deposit"><?php echo e(__('Deposit')); ?></option>
                        <option value="payout"><?php echo e(__('Payout')); ?></option>
                    </select>
                </div>
                <div class="fv-row mb-6">
                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Status')); ?></label>
                    <select class="form-select form-select-solid" wire:model="status">
                        <option value=""><?php echo e(__('Select status')); ?></option>
                        <option value="success"><?php echo e(__('Completed')); ?></option>
                        <option value="pending"><?php echo e(__('Pending')); ?></option>
                        <option value="failed"><?php echo e(__('Failed/Cancelled')); ?></option>
                        <option value="declined"><?php echo e(__('Declined')); ?></option>
                    </select>
                </div>
                <div class="fv-row mb-6">
                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Credit / Debit')); ?></label>
                    <select class="form-select form-select-solid" wire:model="trx_type">
                        <option value=""><?php echo e(__('Select type')); ?></option>
                        <option value="credit"><?php echo e(__('Credit')); ?></option>
                        <option value="debit"><?php echo e(__('Debit')); ?></option>
                    </select>
                </div>
                <div class="fv-row mb-6">
                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Sort by')); ?></label>
                    <select class="form-select form-select-solid" wire:model="sortBy">
                        <option value="created_at"><?php echo e(__('Date')); ?></option>
                        <option value="amount"><?php echo e(__('Amount')); ?></option>
                    </select>
                </div>
                <div class="fv-row mb-6">
                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Order by')); ?></label>
                    <select class="form-select form-select-solid" wire:model="orderBy">
                        <option value="asc"><?php echo e(__('ASC')); ?></option>
                        <option value="desc"><?php echo e(__('DESC')); ?></option>
                    </select>
                </div>
                <div class="fv-row mb-6">
                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Per page')); ?></label>
                    <select class="form-select form-select-solid" wire:model="perPage">
                        <option value="10"><?php echo e(__('10')); ?></option>
                        <option value="25"><?php echo e(__('25')); ?></option>
                        <option value="50"><?php echo e(__('50')); ?></option>
                        <option value="100"><?php echo e(__('100')); ?></option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="row g-xl-8">
                <div class="col-md-6">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="col-md-12">
                            <div class="input-group input-group-solid mb-5 rounded-4">
                                <span class="input-group-text" id="basic-addon1"><i class="fal fa-search"></i></span>
                                <input type="search" class="form-control form-control-solid text-dark" wire:model="search" placeholder="<?php echo e(__('Transaction reference')); ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <button id="kt_filter_button" class="btn btn-white text-dark me-4"><i class="fal fa-filter-list"></i> <?php echo e(__('Filter')); ?></button>
                    <button data-bs-toggle="modal" data-bs-target="#export" class="btn btn-dark"><i class="fal fa-file-export"></i> <?php echo e(__('Export')); ?></button>
                </div>
            </div>
            <div wire:ignore.self class="modal fade" id="export" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title"><?php echo e(__('Export Transactions')); ?></h3>
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <span class="svg-icon svg-icon-1">
                                    <i class="fal fa-times"></i>
                                </span>
                            </div>
                        </div>
                        <form wire:submit.prevent="save(Object.fromEntries(new FormData($event.target)))">
                            <div class="modal-body">
                                <?php echo csrf_field(); ?>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('File Format')); ?></label>
                                    <select class="form-select form-select-solid" name="exportType" required>
                                        <option value=""><?php echo e(__('Select file type')); ?></option>
                                        <option value="csv"><?php echo e(__('CSV')); ?></option>
                                        <option value="excel"><?php echo e(__('Excel')); ?></option>
                                    </select>
                                </div>
                                <?php $__errorArgs = ['exportType'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-text"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Export as')); ?></label>
                                    <select class="form-select form-select-solid" name="exportAs" required>
                                        <option value=""><?php echo e(__('How do you want to receive this file?')); ?></option>
                                        <option value="download"><?php echo e(__('Download file')); ?></option>
                                        <option value="email"><?php echo e(__('Send file to email')); ?></option>
                                    </select>
                                </div>
                                <?php $__errorArgs = ['exportAs'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-text"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-block btn-info" type="submit"><i class="fal fa-file-export"></i>
                                    <span wire:loading.remove wire:target="save"><?php echo e(__('Export')); ?></span>
                                    <span wire:loading wire:target="save"><?php echo e(__('Exporting file...')); ?></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php if($transactions->count() > 0): ?>
            <div class="" wire:loading.class.delay="opacity-50" wire:target="search, status, orderBy, perPage, date, loadMore">
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-bordered table-row-gray-300 gy-5 gs-7" id="kt_datatable_example_5">
                            <thead>
                                <tr class="text-start text-dark fw-bolder fs-7 text-uppercase px-7">
                                    <th></th>
                                    <th class="min-w-150px"><?php echo e(__('Amount')); ?></th>
                                    <th class="min-w-150px"><?php echo e(__('Fee')); ?></th>
                                    <th class="min-w-150px"><?php echo e(__('Type')); ?></th>
                                    <th class="min-w-50px"><?php echo e(__('Status')); ?></th>
                                    <th class="min-w-50px"><?php echo e(__('Reference ID')); ?></th>
                                    <th class="min-w-200px"><?php echo e(__('Created')); ?></th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <tbody class="fw-semibold text-dark fs-6">
                                <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="cursor-pointer" id="kt_trx_<?php echo e($val->id); ?>_button">
                                    <td>
                                        <div class="symbol symbol-40px symbol-circle me-5">
                                            <div class="symbol-label fs-3 fw-bolder text-dark">
                                                <?php if($val->trx_type == 'debit'): ?>
                                                <i class="fal fa-minus"></i>
                                                <?php else: ?>
                                                <i class="fal fa-plus"></i>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo e($currency->currency_symbol.currencyFormat(number_format($val->amount, 2)).' '.$currency->currency); ?></td>
                                    <td><?php echo e($currency->currency_symbol.currencyFormat(number_format($val->charge, 2)).' '.$currency->currency); ?></td>
                                    <td><?php echo e(ucwords(str_replace('_', ' ', $val->type))); ?></td>
                                    <td><span class="badge badge-pill badge-secondary badge-sm"><?php echo e(ucwords($val->status)); ?></span></td>
                                    <td><?php echo e($val->ref_id); ?></td>
                                    <td><?php echo e($val->created_at->toDayDateTimeString()); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php if($transactions->total() > 0 && $transactions->count() < $transactions->total()): ?><button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block">See more</button><?php endif; ?>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="text-center mt-20">
                <img src="<?php echo e(asset('asset/images/transactions.png')); ?>" style="height:auto; max-width:150px;" class="mb-6">
                <h3 class="text-dark"><?php echo e(__('No Transactions Found')); ?></h3>
                <p class="text-dark"><?php echo e(__('We couldn\'t find any transactions to this account')); ?></p>
            </div>
            <?php endif; ?>
        </div>
        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.users.trx-details', ['val' => $val,'admin' => $admin])->html();
} elseif ($_instance->childHasBeenRendered('kt_trx_'. $val->id)) {
    $componentId = $_instance->getRenderedChildComponentId('kt_trx_'. $val->id);
    $componentTag = $_instance->getRenderedChildComponentTagName('kt_trx_'. $val->id);
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('kt_trx_'. $val->id);
} else {
    $response = \Livewire\Livewire::mount('admin.users.trx-details', ['val' => $val,'admin' => $admin]);
    $html = $response->html();
    $_instance->logRenderedChild('kt_trx_'. $val->id, $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/livewire/admin/users/transactions.blade.php ENDPATH**/ ?>