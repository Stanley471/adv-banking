<div>
    <div wire:ignore.self id="kt_message_<?php echo e($val->id); ?>" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_message_<?php echo e($val->id); ?>_button" data-kt-drawer-close="#kt_message_<?php echo e($val->id); ?>_close" data-kt-drawer-width="{'md': '500px'}">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1"><?php echo e(__('Manage Ticket')); ?></div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_message_<?php echo e($val->id); ?>_close">
                        <span class="svg-icon svg-icon-2">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body text-wrap">
                <div class="pb-5 mt-10 position-relative zindex-1">
                    <div class="bg-light px-6 py-5 mb-10 rounded">
                        <p class="text-dark fs-6 fw-bolder"><?php echo e(__('Ticket Details')); ?></p>
                        <li class="d-flex align-items-center py-2">
                            <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Ticket ID')); ?>: <?php echo e($val->ticket_id); ?> <i class="fal fa-clone castro-copy fs-5" data-clipboard-text="<?php echo e($val->ticket_id); ?>" title="Copy"></i></span>
                        </li>
                        <li class="d-flex align-items-center py-2">
                            <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Subject')); ?>: <?php echo e($val->subject); ?></span>
                        </li>
                        <li class="d-flex align-items-center py-2">
                            <span class="bullet me-5 bg-info bullet-vertical"></span> <span><?php echo e(__('Created')); ?>: <?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></span>
                        </li>
                        <?php if($val->files != null): ?>
                        <div class="overflow-auto pb-5">
                            <div class="d-flex align-items-center border border-dashed border-gray-400 rounded p-3">
                                <?php $__currentLoopData = explode(',', $val->files); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $files): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(url('/').'/storage/app/'.$files); ?>" target="_blank" class="text-dark me-2"><i class="fal fa-file-alt fs-2"></i></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-body" id="kt_chat_messenger_body" wire:poll.visible>
                        <div class="scroll-y me-n5 pe-5 h-300px h-lg-auto" id="scrollToBottom" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer" data-kt-scroll-wrappers="#kt_content, #kt_chat_messenger_body" data-kt-scroll-offset="-2px" style="max-height: 266px;">
                            <div class="d-flex justify-content-end mb-10">
                                <div class="d-flex flex-column align-items-end">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="me-3">
                                            <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1"><?php echo e($user->business->name); ?></a>
                                            <span class="text-muted fs-7 mb-1"><?php echo e($val->created_at->diffForHumans()); ?></span>
                                        </div>
                                        <div class="symbol symbol-35px symbol-circle">
                                            <div class="symbol-label fs-5 fw-bolder text-dark bg-light-info"><?php echo e(strtoupper(substr($user->business->name, 0, 2))); ?></div>
                                        </div>
                                    </div>
                                    <div class="p-5 rounded bg-light-info text-dark fw-bold mw-lg-400px text-start preserveLines" data-kt-element="message-text"><?php echo e($val->message); ?></div>
                                </div>
                            </div>
                            <?php if($val->reply->count()>0): ?>
                            <?php $__currentLoopData = $val->reply; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-flex <?php echo e(($reply->status == 1) ? 'justify-content-start' : 'justify-content-end'); ?> mb-10">
                                <div class="d-flex flex-column <?php echo e(($reply->status == 1) ? 'align-items-start' : 'align-items-end'); ?>">
                                    <div class="d-flex align-items-center mb-2">
                                        <?php if($reply->status == 0): ?>
                                        <div class="me-3">
                                            <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1"><?php echo e($user->business->name); ?></a>
                                            <span class="text-muted fs-7 mb-1"><?php echo e($val->created_at->diffForHumans()); ?></span>
                                        </div>
                                        <div class="symbol symbol-35px symbol-circle">
                                            <div class="symbol-label fs-5 fw-bolder text-dark bg-light-info"><?php echo e(strtoupper(substr($user->business->name, 0, 2))); ?></div>
                                        </div>
                                        <?php else: ?>
                                        <div class="me-3">
                                            <span class="text-muted fs-7 mb-1"><?php echo e($val->created_at->diffForHumans()); ?></span>
                                            <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary ms-1"><?php echo e($reply->staff->first_name.' '.$reply->staff->last_name); ?></a>
                                        </div>
                                        <div class="symbol symbol-35px symbol-circle">
                                            <div class="symbol-label fs-5 fw-bolder text-dark"><i class="fal fa-university"></i></div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="p-5 rounded text-dark fw-bold mw-lg-400px preserveLines text-start <?php echo e(($reply->status == 1) ? 'bg-light-primary' : 'bg-light-info'); ?>" data-kt-element="message-text"><?php echo e($reply->reply); ?></div>
                                    <?php if($reply->status == 0): ?>
                                    <?php if($reply->files != null): ?>
                                    <div class="overflow-auto pb-5">
                                        <div class="d-flex align-items-center border border-dashed border-gray-400 rounded p-2 mt-1">
                                            <?php $__currentLoopData = explode(',', $reply->files); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $files): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a href="<?php echo e(url('/').'/storage/app/'.$files); ?>" target="_blank" class="text-dark me-2"><i class="fal fa-file-alt fs-3"></i></a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if($val->status == 0): ?>
                    <div class="card-footer pt-4" id="kt_chat_messenger_footer">
                        <form class="form w-100 mb-10" wire:submit.prevent="reply" method="post">
                            <textarea class="form-control form-control-flush mb-3 preserveLines" rows="3" wire:model.defer="message" placeholder="Type a message" required></textarea>
                            <div class="fv-row mb-6">
                                <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Attachment - Optional')); ?></label>
                                <input class="form-control form-control-sm form-control-solid" type="file" wire:model="files" multiple />
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
                            <button class="btn btn-info btn-block" type="submit">
                                <span wire:loading.remove wire:target="reply"><?php echo e(__('Send')); ?></span>
                                <span wire:loading wire:target="reply"><?php echo e(__('Replying ticket...')); ?></span>
                            </button>
                        </form>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/livewire/ticket/user-reply.blade.php ENDPATH**/ ?>