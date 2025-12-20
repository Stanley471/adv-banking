<div>
    <div wire:ignore.self class="modal fade" id="delete<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><?php echo e(__('Delete Plan')); ?></h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this plan?</p>
                    <div class="text-center">
                        <a wire:click="delete" class="btn btn-danger btn-block"><?php echo e(__('Delete plan')); ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('livewire:load', function () {
    tinymce.init({
        selector: 'textarea.tinymce<?php echo e($val->id); ?>',
        forced_root_block: false,
        setup: function (editor) {
            editor.on('init change', function () {
                editor.save();
            });
            editor.on('change', function (e) {
                window.livewire.find('<?php echo e($_instance->id); ?>').set('val.details', editor.getContent());
            });
        }
    });
});
</script>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/livewire/admin/invest/delete-plan.blade.php ENDPATH**/ ?>