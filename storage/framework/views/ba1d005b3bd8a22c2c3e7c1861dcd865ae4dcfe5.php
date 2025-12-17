<div>
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <h1 class="text-dark fw-bolder my-1 fs-2"><?php echo e(__('Support Ticket')); ?></h1>
                <ul class="breadcrumb fw-semibold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="<?php echo e(route('user.dashboard')); ?>" class="text-muted text-hover-primary"><?php echo e(__('Dashboard')); ?></a>
                    </li>
                    <li class="breadcrumb-item text-dark"><?php echo e(__('Tickets')); ?></li>
                </ul>
            </div>
            <div class="d-flex align-items-center flex-nowrap text-nowrap py-1">
                <button data-bs-toggle="modal" data-bs-target="#filter" class="btn btn-white text-dark me-4"><i class="fal fa-filter-list"></i> <?php echo e(__('Filter')); ?></button>
                <button id="kt_ticket_button" class="btn btn-dark me-4"><i class="fal fa-plus"></i> <?php echo e(__('Open Ticket')); ?></button>
                <div wire:ignore.self id="kt_ticket" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_ticket_button" data-kt-drawer-close="#kt_ticket_close" data-kt-drawer-width="{'md': '500px'}">
                    <div class="card w-100">
                        <div class="card-header pe-5 border-0">
                            <div class="card-title">
                                <div class="d-flex justify-content-center flex-column me-3">
                                    <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1"><?php echo e(__('Open Ticket')); ?></div>
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_ticket_close">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fal fa-times"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-wrap">
                            <div class="btn-wrapper text-center mb-3">
                                <div class="symbol symbol-100px symbol-circle me-5 mb-10">
                                    <div class="symbol-label fs-1 text-dark">
                                        <i class="fal fa-clipboard-list-check fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="pb-5 mt-10 position-relative zindex-1">
                                <form class="form w-100 mb-10" wire:submit.prevent="addTicket" method="post">
                                    <div class="fv-row mb-6">
                                        <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Title')); ?></label>
                                        <input class="form-control form-control-lg form-control-solid" type="text" wire:model="subject" required placeholder="Title of complaint" />
                                        <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="form-text text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="fv-row mb-6">
                                        <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Priority')); ?></label>
                                        <select class="form-select form-select-solid" wire:model="selectPriority" required>
                                            <option value="low"><?php echo e(__('Low')); ?></option>
                                            <option value="medium"><?php echo e(__('Medium')); ?></option>
                                            <option value="high"><?php echo e(__('High')); ?></option>
                                        </select>
                                        <?php $__errorArgs = ['selectPriority'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="form-text text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="fv-row mb-6">
                                        <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Description')); ?></label>
                                        <textarea class="form-control form-control-lg form-control-solid preserveLines" rows="6" type="text" wire:model="details" required placeholder="Whats your complaint?"></textarea>
                                        <?php $__errorArgs = ['details'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="form-text text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="fv-row mb-6">
                                        <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Attachment - Optional')); ?></label>
                                        <input class="form-control form-control-lg form-control-solid" type="file" wire:model="files" multiple />
                                        <?php $__errorArgs = ['files.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="form-text text-danger"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="text-center mt-10">
                                        <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                            <span wire:loading.remove wire:target="addTicket"><?php echo e(__('Submit Ticket')); ?></span>
                                            <span wire:loading wire:target="addTicket"><?php echo e(__('Processing Request...')); ?></span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="row g-xl-8">
                <div wire:ignore.self class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title"><?php echo e(__('Filter Ticket')); ?></h3>
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <span class="svg-icon svg-icon-1">
                                        <i class="fal fa-times"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Type')); ?></label>
                                    <select class="form-select form-select-solid" wire:model="status">
                                        <option value=""><?php echo e(__('All')); ?></option>
                                        <option value="0"><?php echo e(__('Open')); ?></option>
                                        <option value="1"><?php echo e(__('Closed')); ?></option>
                                    </select>
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Priority')); ?></label>
                                    <select class="form-select form-select-solid" wire:model="priority">
                                        <option value=""><?php echo e(__('All')); ?></option>
                                        <option value="low"><?php echo e(__('Low')); ?></option>
                                        <option value="medium"><?php echo e(__('Medium')); ?></option>
                                        <option value="high"><?php echo e(__('High')); ?></option>
                                    </select>
                                </div>
                                <div class="fv-row mb-6">
                                    <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Sort by')); ?></label>
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
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="col-md-12">
                            <div class="input-group input-group-solid mb-5 rounded-4">
                                <span class="input-group-text" id="basic-addon1"><i class="fal fa-search"></i></span>
                                <input type="search" class="form-control form-control-solid text-dark" wire:model="search" placeholder="<?php echo e(__('Search ticket')); ?>" />
                            </div>
                        </div>
                    </div>
                    <?php if($ticket->count() > 0): ?>
                    <div class="card-body" wire:loading.class.delay="opacity-50" wire:target="search, status, orderBy, perPage">
                        <?php $__currentLoopData = $ticket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="d-flex flex-stack cursor-pointer" id="kt_message_<?php echo e($tt->id); ?>_button">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-45px symbol-circle me-4">
                                    <div class="symbol-label fs-2 fw-bolder text-dark">
                                        <i class="fal fa-clipboard-list-check"></i>
                                    </div>
                                </div>
                                <div class="ps-1">
                                    <p href="#" class="fs-6 text-dark text-hover-primary fw-bolder mb-0"><?php echo e($tt->ticket_id); ?></p>
                                    <p href="#" class="fs-6 text-dark mb-0"><?php echo e($tt->subject); ?></p>
                                    <p href="#" class="fs-6 text-dark mb-2"><?php echo e(date("Y/m/d h:i:A", strtotime($tt->created_at))); ?></p>

                                    <?php if($tt->status == 0): ?>
                                    <span class="badge badge-sm badge-info"><?php echo e(__('Open')); ?> </span>
                                    <?php else: ?>
                                    <span class="badge badge-sm badge-danger"><?php echo e(__('Closed')); ?> </span>
                                    <?php endif; ?>

                                    <span class="badge badge-sm badge-secondary"><?php echo e(__('Priority: ').ucwords($tt->priority)); ?></span>
                                    <?php if($tt->files != null): ?>
                                    <span class="badge badge-sm badge-secondary"><i class="fal fa-paperclip"></i> Attachment</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <button class="btn btn-white text-dark fw-bolder btn-sm px-5"><?php echo e(__('Details')); ?></button>
                        </div>
                        <?php if(!$loop->last): ?>
                        <hr class="bg-light-border">
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($ticket->total() > 0 && $ticket->count() < $ticket->total()): ?><button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block"><?php echo e(__('See more')); ?></button><?php endif; ?>
                    </div>
                    <?php else: ?>
                    <div class="text-center mt-20">
                        <img src="<?php echo e(asset('asset/images/transactions.png')); ?>" style="height:auto; max-width:200px;" class="mb-6">
                        <h3 class="text-dark"><?php echo e(__('No Ticket')); ?></h3>
                        <p class="text-dark"><?php echo e(__('We couldn\'t find any ticket to this account')); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php $__currentLoopData = $ticket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('ticket.user-reply', ['val' => $val,'user' => $user,'settings' => $set])->html();
} elseif ($_instance->childHasBeenRendered('kt_message_'. $val->id)) {
    $componentId = $_instance->getRenderedChildComponentId('kt_message_'. $val->id);
    $componentTag = $_instance->getRenderedChildComponentTagName('kt_message_'. $val->id);
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('kt_message_'. $val->id);
} else {
    $response = \Livewire\Livewire::mount('ticket.user-reply', ['val' => $val,'user' => $user,'settings' => $set]);
    $html = $response->html();
    $_instance->logRenderedChild('kt_message_'. $val->id, $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->startPush('scripts'); ?>
<script>
    var element = $('#scrollToBottom');
    element.scrollTop(element[0].scrollHeight);

    window.livewire.on('newChat', function() {
        var element = $('#scrollToBottom');
        element.scrollTop(element[0].scrollHeight);
    });
</script>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/livewire/ticket/user.blade.php ENDPATH**/ ?>