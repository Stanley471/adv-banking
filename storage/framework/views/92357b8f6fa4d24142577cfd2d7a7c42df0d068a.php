<div>
    <div wire:ignore.self class="modal fade" id="delete<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><?php echo e(__('Delete Bank Account')); ?></h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this bank account?</p>
                    <div class="text-center">
                        <a wire:click="delete" class="btn btn-danger btn-block"><?php echo e(__('Delete Bank Account')); ?></span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/livewire/bank/edit.blade.php ENDPATH**/ ?>