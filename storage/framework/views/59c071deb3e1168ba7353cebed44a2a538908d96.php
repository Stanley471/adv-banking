<div>
    <div wire:ignore.self class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><?php echo e(__('Filter Messages')); ?></h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="fv-row mb-6">
                        <label class="form-label fs-5 fw-bolder text-dark"><?php echo e(__('Category')); ?></label>
                        <select class="form-select form-select-solid" wire:model="category" required>
                            <option value="">Select Category</option>
                            <?php $__currentLoopData = $categoryAll; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($val->id); ?>"><?php echo e($val->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['category'];
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
                        <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Sort by')); ?></label>
                        <select class="form-select form-select-solid" wire:model="sortBy">
                            <option value="asc"><?php echo e(__('ASC')); ?></option>
                            <option value="desc"><?php echo e(__('DESC')); ?></option>
                        </select>
                    </div>
                    <div class="fv-row mb-6">
                        <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Order by')); ?></label>
                        <select class="form-select form-select-solid" wire:model="orderBy">
                            <option value="interest"><?php echo e(__('Interest')); ?></option>
                            <option value="start_date"><?php echo e(__('Start Date')); ?></option>
                            <option value="close_date"><?php echo e(__('Close Date')); ?></option>
                            <option value="original"><?php echo e(__('Units')); ?></option>
                            <option value="duration"><?php echo e(__('Duration')); ?></option>
                            <option value="created_at"><?php echo e(__('Date')); ?></option>
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
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="row g-xl-8">
                <div class="col-md-8">
                    <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                        <div class="input-group input-group-solid mb-5 rounded-4">
                            <span class="input-group-text" id="basic-addon1"><i class="fal fa-search"></i></span>
                            <input type="search" class="form-control form-control-solid text-dark" wire:model="search" placeholder="<?php echo e(__('Search plans')); ?>" />
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <button data-bs-toggle="modal" data-bs-target="#filter" class="btn btn-light text-dark me-4"><i class="fal fa-filter-list"></i> <?php echo e(__('Filter')); ?></button>
                    <button id="kt_article_button" class="btn btn-info me-4"><i class="fal fa-pie-chart"></i> <?php echo e(__('Add plan')); ?></button>
                </div>
            </div>
            <div wire:ignore.self id="kt_article" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_article_button" data-kt-drawer-close="#kt_article_close" data-kt-drawer-width="{'md': '1000px'}">
                <div class="card w-100">
                    <div class="card-header pe-5 border-0">
                        <div class="card-title">
                            <div class="d-flex justify-content-center flex-column me-3">
                                <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1"><?php echo e(__('Create a Plan')); ?></div>
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_article_close">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fal fa-times"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-wrap">
                        <div class="pb-5 mt-10 position-relative zindex-1">
                            <form class="form w-100 mb-10" wire:submit.prevent="addPlan" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <!--begin::Thumbnail settings-->
                                        <div class="card card-flush py-4">
                                            <!--begin::Card body-->
                                            <div class="card-body text-center pt-0" wire:ignore>
                                                <!--begin::Image input-->
                                                <!--begin::Image input placeholder-->
                                                <style>
                                                    .image-input-placeholder {
                                                        background-image: url(<?php echo e(asset('dashboard/media/svg/files/blank-image.svg')); ?>)
                                                    }
                                                </style>
                                                <!--end::Image input placeholder-->

                                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                                    <!--begin::Preview existing avatar-->
                                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                                    <!--end::Preview existing avatar-->

                                                    <!--begin::Label-->
                                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change avatar" data-bs-original-title="Change avatar" data-kt-initialized="1">
                                                        <i class="bi bi-pencil-fill fs-7"></i>

                                                        <!--begin::Inputs-->
                                                        <input type="file" wire:model="image" id="image" accept=".png, .jpg, .jpeg" required>
                                                        <input type="hidden" name="avatar_remove">
                                                        <!--end::Inputs-->
                                                    </label>
                                                    <!--end::Label-->

                                                    <!--begin::Cancel-->
                                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancel avatar" data-bs-original-title="Cancel avatar" data-kt-initialized="1">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>
                                                    <!--end::Cancel-->

                                                    <!--begin::Remove-->
                                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Remove avatar" data-bs-original-title="Remove avatar" data-kt-initialized="1">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>
                                                    <!--end::Remove-->
                                                </div>
                                                <!--end::Image input-->

                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">Set the thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
                                                <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="form-text text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <div class="fv-row mb-6">
                                            <label class="form-label fs-5 fw-bolder text-dark"><?php echo e(__('Category')); ?></label>
                                            <select class="form-select form-select-solid" wire:model.defer="selectCategory" required>
                                                <option value="">Select Category</option>
                                                <?php $__currentLoopData = $categoryAll; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($val->id); ?>"><?php echo e($val->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['selectCategory'];
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
                                            <label class="form-label fs-5 fw-bolder text-dark"><?php echo e(__('Status')); ?></label>
                                            <select class="form-select form-select-solid" wire:model.defer="status" required>
                                                <option value="1"><?php echo e(__('Published')); ?></option>
                                                <option value="0"><?php echo e(__('Disabled')); ?></option>
                                            </select>
                                            <?php $__errorArgs = ['status'];
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
                                            <label class="form-label fs-5 fw-bolder text-dark"><?php echo e(__('Insured')); ?></label>
                                            <select class="form-select form-select-solid" wire:model.defer="insurance" required>
                                                <option value="0"><?php echo e(__('No')); ?></option>
                                                <option value="1"><?php echo e(__('Yes')); ?></option>
                                            </select>
                                            <?php $__errorArgs = ['insurance'];
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
                                            <label class="form-label fs-5 fw-bolder text-dark"><?php echo e(__('Minimum Buying Units')); ?></label>
                                            <input type="number" wire:model.defer="min_buy" placeholder="<?php echo e(__('least amount of units that can be bought')); ?>" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                            <?php $__errorArgs = ['min_buy'];
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
                                        <div wire:ignore>
                                            <div class="fv-row mb-6">
                                                <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Investment fee type')); ?></label>
                                                <select class="form-select form-select-solid" wire:model.defer="fee_type" id="fee" required>
                                                    <option value="both">Percentage & Fiat</option>
                                                    <option value="percent">Percentage</option>
                                                    <option value="fiat">Fiat</option>
                                                    <option value="none">No fees</option>
                                                    <option value="min">Below</option>
                                                    <option value="max">Above</option>
                                                </select>
                                                <?php $__errorArgs = ['fee_type'];
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
                                                <div class="input-group">
                                                    <input type="number" step="any" wire:model.defer="percent_pc" id="percent_pc" placeholder="<?php echo e(__('Percent charge')); ?>" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                                    <span class="input-group-text border-0">%</span>
                                                </div>
                                                <?php $__errorArgs = ['percent_pc'];
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
                                                <div class="input-group">
                                                    <span class="input-group-text border-0"><?php echo e($currency->currency_symbol); ?></span>
                                                    <input type="number" step="any" wire:model.defer="fiat_pc" id="fiat_pc" placeholder="<?php echo e(__('Fiat charge')); ?>" autocomplete="off" class="form-control form-control-lg form-control-solid">
                                                </div>
                                                <?php $__errorArgs = ['fiat_pc'];
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
                                    </div>
                                    <div class="col-md-8">
                                        <div class="fv-row mb-6">
                                            <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="name" required placeholder="Name of Plan" />
                                            <?php $__errorArgs = ['name'];
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
                                            <label class="col-form-label"><?php echo e(__('Price per units')); ?></label>
                                            <div class="input-group">
                                                <span class="input-group-text border-0"><?php echo e($currency->currency_symbol); ?></span>
                                                <input type="number" wire:model.defer="price" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="0.00">
                                            </div>
                                            <?php $__errorArgs = ['price'];
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
                                            <label class="col-form-label"><?php echo e(__('Investment Interest')); ?></label>
                                            <div class="input-group">
                                                <input type="number" wire:model.defer="interest" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="1">
                                                <span class="input-group-text border-0">%</span>
                                            </div>
                                            <?php $__errorArgs = ['interest'];
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
                                            <label class="col-form-label"><?php echo e(__('Investment duration')); ?></label>
                                            <div class="input-group">
                                                <input type="number" wire:model.defer="duration" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="1">
                                                <span class="input-group-text border-0"><?php echo e(__('Months')); ?></span>
                                            </div>
                                            <?php $__errorArgs = ['duration'];
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
                                            <label class="col-form-label"><?php echo e(__('Total number of units')); ?></label>
                                            <input type="number" wire:model.defer="units" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="units">
                                            <?php $__errorArgs = ['units'];
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
                                            <label class="col-form-label"><?php echo e(__('Site Location')); ?></label>
                                            <input type="text" wire:model.defer="location" steps="any" class="form-control form-control-lg form-control-solid" required placeholder="Location of operations">
                                            <?php $__errorArgs = ['location'];
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
                                            <label class="col-form-label"><?php echo e(__('Start - Close Date for buying units')); ?></label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="date" wire:model.defer="start_date" class="form-control form-control-lg form-control-solid" required value="<?php echo e(Carbon\Carbon::now()->format('d/m/Y')); ?>">
                                                    <span class="form-text"><?php echo e(__('Investors can buy units from this day')); ?></span>
                                                    <?php $__errorArgs = ['start_date'];
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
                                                <div class="col-md-6">
                                                    <input type="date" wire:model.defer="close_date" class="form-control form-control-lg form-control-solid" required>
                                                    <span class="form-text"><?php echo e(__('The window for investors to invest is closed on this day, it must be greater than start date')); ?></span>
                                                    <?php $__errorArgs = ['close_date'];
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
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="fv-row mb-6">
                                            <textarea class="form-control form-control-lg form-control-solid" rows="10" type="text" wire:model.defer="details" placeholder="Detailed description of project"></textarea>
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
                                        <div class="text-center mt-10">
                                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                                <span wire:loading.remove wire:target="addPlan"><?php echo e(__('Submit Plan')); ?></span>
                                                <span wire:loading wire:target="addPlan"><?php echo e(__('Processing Request...')); ?></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($plans->count() > 0): ?>
            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card mb-9 rounded-5">
                <div class="card-body pt-9 pb-0">
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                        <div class="symbol symbol-100px me-7 mb-4 symbol-circle">
                            <span class="symbol-label" style="background-image:url(<?php echo e(url('/').'/storage/app/'.$val->image); ?>);"></span>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <div class="d-flex flex-column">
                                    <p class="text-dark fs-1 fw-boldest me-3 mb-0"><?php echo e(substr($val->name, 0, 30)); ?><?php echo e((Str::length($val->name) > 30) ? '...' : ''); ?></p>
                                    <p class="text-gray-800 fs-5 me-3 mb-3"><?php echo e($val->location); ?></p>
                                    <p>
                                        <span class="badge badge-light-info"><?php echo e($val->category->name); ?></span>
                                        <span class="badge badge-light-info"><?php echo e($val->duration.' Months'); ?></span>
                                        <span class="badge badge-light-info"><?php echo e(($val->status == 1) ? 'Published' : 'Disabled'); ?></span>
                                        <span class="badge badge-light-info"><?php echo e(($val->insurance == 1) ? 'Insured' : 'No Insurance'); ?></span>
                                    </p>
                                    <?php if($val->followed->count()): ?>
                                    <div class="symbol-group symbol-hover mb-3">
                                        <!--begin::User-->
                                        <?php $__currentLoopData = $val->followed->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $followers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="<?php echo e($followers->user->business->name); ?>">
                                            <?php if($followers->user->avatar == null): ?>
                                            <span class="symbol-label bg-warning text-inverse-warning fw-boldest"><?php echo e(substr(ucwords($followers->user->business->name), 0, 1)); ?></span>
                                            <?php else: ?>
                                            <div class="symbol-label" style="background-image:url(<?php echo e(url('/').'/storage/app/'.$followers->user->avatar); ?>)"></div>
                                            <?php endif; ?>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($val->followed->count() > 10): ?>
                                        <div class="symbol symbol-35px symbol-circle">
                                            <span class="symbol-label bg-warning text-dark fs-8 fw-boldest">+<?php echo e($val->followed->count() - 10); ?></span>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="d-flex mb-4">
                                    <a href="<?php echo e(route('admin.invest.plan', ['plan' => $val->id, 'type' => 'edit'])); ?>" class="btn btn-dark me-3">Manage</a>
                                    <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?php echo e($val->id); ?>">Delete</a>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-start">
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-6 fw-boldest text-gray-700"><?php echo e(\Carbon\Carbon::create($val->start_date)->format('M j, Y')); ?> - <?php echo e(\Carbon\Carbon::create($val->close_date)->format('M j, Y')); ?></div>
                                    <div class="fw-bold text-gray-400">Investment Closure</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-6 fw-boldest text-gray-700"><?php echo e(\Carbon\Carbon::create($val->expiring_date)->format('M j, Y')); ?></div>
                                    <div class="fw-bold text-gray-400">Matures</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-6 fw-boldest text-gray-700"><?php echo e(number_format($val->original - $val->units).'/'.number_format($val->original)); ?> units</div>
                                    <div class="fw-bold text-gray-400"><?php echo e($currency->currency_symbol.$val->price); ?> per unit</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-6 fw-boldest text-gray-700"><?php echo e($val->interest); ?>%</div>
                                    <div class="fw-bold text-gray-400">Interest</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-6 fw-boldest text-gray-700">
                                        <?php if($val->fee_type == "both"): ?>
                                        <?php echo e($val->percent_pc); ?>% + <?php echo e($val->fiat_pc.' '.$currency->currency); ?>

                                        <?php elseif($val->fee_type == "fiat"): ?>
                                        <?php echo e($val->fiat_pc.' '.$currency->currency); ?>

                                        <?php elseif($val->fee_type == "percent"): ?>
                                        <?php echo e($val->percent_pc); ?>%
                                        <?php elseif($val->fee_type == "max"): ?>
                                        > <?php echo e($val->fiat_pc.' '.$currency->currency); ?> - <?php echo e($val->percent_pc); ?>%
                                        <?php elseif($val->fee_type == "min"): ?>
                                        < <?php echo e($val->fiat_pc.' '.$currency->currency); ?> - <?php echo e($val->percent_pc); ?>% <?php endif; ?> </div>
                                            <div class="fw-bold text-gray-400">Mtg Fee</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if($plans->total() > 0 && $plans->count() < $plans->total()): ?><button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block"><?php echo e(__('See more')); ?></button><?php endif; ?>
                    <?php else: ?>
                    <div class="text-center mt-20">
                        <img src="<?php echo e(asset('asset/images/beneficiary.png')); ?>" style="height:auto; max-width:250px;" class="mb-6">
                        <h3 class="text-dark"><?php echo e(__('No Investment Plan Found')); ?></h3>
                        <p class="text-dark"><?php echo e(__('We couldn\'t find any investment plan ')); ?></p>
                    </div>
                    <?php endif; ?>
            </div>
        </div>
        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.invest.delete-plan', ['val' => $val,'admin' => $admin])->html();
} elseif ($_instance->childHasBeenRendered('kt_edit_'. $val->id)) {
    $componentId = $_instance->getRenderedChildComponentId('kt_edit_'. $val->id);
    $componentTag = $_instance->getRenderedChildComponentTagName('kt_edit_'. $val->id);
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('kt_edit_'. $val->id);
} else {
    $response = \Livewire\Livewire::mount('admin.invest.delete-plan', ['val' => $val,'admin' => $admin]);
    $html = $response->html();
    $_instance->logRenderedChild('kt_edit_'. $val->id, $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php $__env->startPush('scripts'); ?>
    <script>
        function fee() {
            var fee = $("#fee").find(":selected").val();
            var myarr = fee;
            if (myarr == "both") {
                $("#fiat_pc").attr({
                    required: true,
                    readonly: false,
                    placeholder: 'Fiat charge'
                });
                $("#percent_pc").attr({
                    required: true,
                    readonly: false,
                    placeholder: 'Percent charge'
                });
            } else if (myarr == "fiat") {
                $("#fiat_pc").attr({
                    required: true,
                    readonly: false,
                    placeholder: 'Fiat charge'
                });
                $("#percent_pc").attr({
                    required: false,
                    readonly: true,
                    placeholder: 'Percent charge'
                });
            } else if (myarr == "percent") {
                $("#fiat_pc").attr({
                    required: false,
                    readonly: true,
                    placeholder: 'Fiat charge'
                });
                $("#percent_pc").attr({
                    required: true,
                    readonly: false,
                    placeholder: 'Percent charge'
                });
            } else if (myarr == "none") {
                $("#fiat_pc").attr({
                    required: false,
                    readonly: true,
                    placeholder: 'Fiat charge'
                });
                $("#percent_pc").attr({
                    required: false,
                    readonly: true,
                    placeholder: 'Percent charge'
                });
            } else {
                $("#fiat_pc").attr({
                    required: true,
                    readonly: false,
                    placeholder: 'Amount'
                });
                $("#percent_pc").attr({
                    required: false,
                    readonly: true
                });
            }
        }

        document.addEventListener('livewire:load', function() {
            fee();
        });

        $("#fee").change(fee);
    </script>
    <?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/livewire/admin/invest/project-plans.blade.php ENDPATH**/ ?>