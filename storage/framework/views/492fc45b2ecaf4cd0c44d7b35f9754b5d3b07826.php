<div>
    <div class="card mb-10">
        <div class="card-body text-center">
            <form class="form w-100 mb-10" wire:submit.prevent="save" method="post"  wire:ignore>
                <style>
                    .image-input-placeholder {
                        background-image: url(<?php echo e(($user->avatar == null) ? asset('dashboard/media/svg/files/blank-image.svg'): url('/').'/storage/app/' .$user->avatar); ?>)
                    }
                </style>
                <!--end::Image input placeholder-->
                <p class="fw-bold"><?php echo e(__('Avatar')); ?></p>
                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                    <!--begin::Preview existing avatar-->
                    <div class="image-input-wrapper w-150px h-150px"></div>
                    <!--end::Preview existing avatar-->

                    <!--begin::Label-->
                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change avatar" data-bs-original-title="Change avatar" data-kt-initialized="1">
                        <i class="bi bi-pencil-fill fs-7"></i>

                        <!--begin::Inputs-->
                        <input type="file" wire:model="avatar" id="image" accept=".png, .jpg, .jpeg">
                        <input type="hidden" name="avatar_remove">
                        <!--end::Inputs-->
                    </label>
                    <!--end::Label-->

                    <!--begin::Remove-->
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Remove avatar" data-bs-original-title="Remove avatar" data-kt-initialized="1">
                        <i class="bi bi-x fs-2"></i>
                    </span>
                    <!--end::Remove-->
                </div>
                <!--end::Image input-->

                <!--begin::Description-->
                <div class="text-muted fs-7">Set the thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
                <div class="text-center mt-10">
                    <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                        <span wire:loading.remove wire:target="save"><?php echo e(__('Upload Avatar')); ?></span>
                        <span wire:loading wire:target="save"><?php echo e(__('Uploading Avatar...')); ?></span>
                    </button>
                </div>
            </form>
            <?php $__errorArgs = ['avatar'];
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
    </div>
</div><?php /**PATH /home/soccrquq/clovergatebank.com/resources/views/livewire/settings/avatar.blade.php ENDPATH**/ ?>