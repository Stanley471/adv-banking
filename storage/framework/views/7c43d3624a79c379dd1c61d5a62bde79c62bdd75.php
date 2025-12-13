<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="position-relative py-lg-5 pt-5" style="background-image: url(<?php echo e(asset('asset/images/auth.svg')); ?>);" data-jarallax data-img-position="0% 100%" data-speed="0.5">
    <div class="container position-relative zindex-2 pt-5 pb-2 pb-md-0 py-6">
        <div class="row justify-content-center pt-3 mt-3">
            <div class="col-xl-6 col-lg-7 col-md-8 col-sm-10 text-center">
                <h1 class="mb-4"><?php echo e(__('About Us')); ?></h1>
            </div>
        </div>
    </div>
</section>
<section class="container py-5 mt-md-3 my-lg-5">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4 px-4">
                    <img src="<?php echo e(asset('asset/images/'.getUi()->image6)); ?>" class="rounded-5" alt="Invest">
                    <div class="pt-4 text-center">
                        <h3 class="text-dark"><?php echo e(getUi()->w1_t); ?></h3>
                        <p class="text-dark"><?php echo e(getUi()->w1_b); ?></p>
                    </div>
                </div>
                <div class="col-md-4 px-4">
                    <img src="<?php echo e(asset('asset/images/'.getUi()->image7)); ?>" class="rounded-5" alt="Savings">
                    <div class="pt-4 text-center">
                        <h3 class="text-dark"><?php echo e(getUi()->w2_t); ?></h3>
                        <p class="text-dark"><?php echo e(getUi()->w2_b); ?></p>
                    </div>
                </div>
                <div class="col-md-4 px-4">
                    <img src="<?php echo e(asset('asset/images/'.getUi()->image8)); ?>" class="rounded-5" alt="Loan">
                    <div class="pt-4 text-center">
                        <h3 class="text-dark"><?php echo e(getUi()->w3_t); ?></h3>
                        <p class="text-dark"><?php echo e(getUi()->w3_b); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="container mt-2 pt-3 pt-lg-5 pb-5">
    <div class="row align-items-lg-center pt-md-3 pb-5 mb-2 mb-lg-4 mb-xl-5">
        <div class="col-md-6">
            <div class="pe-xl-5 me-md-2 me-lg-4">
                <p class="text-info">Our vision</p>
                <h2 class="pb-3 text-dark"><?php echo e(getUi()->mission1); ?></h2>
            </div>
        </div>
        <div class="col-md-6 mb-4 mb-md-0">
            <img src="<?php echo e(asset('asset/images/'.getUi()->image9)); ?>">
        </div>
    </div>
</section>
<section class="container mt-2 pt-3 pt-lg-5 pb-5">
    <div class="row align-items-lg-center pt-md-3 pb-5 mb-2 mb-lg-4 mb-xl-5">
        <div class="col-md-6 mb-4 mb-md-0">
            <img src="<?php echo e(asset('asset/images/'.getUi()->image10)); ?>">
        </div>
        <div class="col-md-6">
            <div class="pe-xl-5 me-md-2 me-lg-4">
                <p class="text-info">Our mission</p>
                <h2 class="pb-3 text-dark"><?php echo e(getUi()->mission2); ?></h2>
            </div>
        </div>
    </div>
</section>
<section class="container mt-2 pt-3 pt-lg-5 pb-5">
    <div class="row align-items-lg-center pt-md-3 pb-5 mb-2 mb-lg-4 mb-xl-5">
        <div class="col-md-6">
            <div class="pe-xl-5 me-md-2 me-lg-4">
                <p class="text-info">We believe in team work</p>
                <h2 class="pb-3 text-dark"><?php echo e(getUi()->mission3); ?></h2>
            </div>
        </div>
        <div class="col-md-6 mb-4 mb-md-0">
            <img src="<?php echo e(asset('asset/images/'.getUi()->image11)); ?>">
        </div>
    </div>
</section>
<section class="container py-5 my-md-3 my-lg-5">
    <h2 class="h3 text-center pt-1 pb-3 mb-3 mb-lg-4"><?php echo e(__('Meet The Team')); ?></h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-6 g-4">

        <!-- Item -->
        <?php $__currentLoopData = getTeam(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col">
            <div class="card card-hover border-0 bg-transparent">
                <div class="position-relative">
                    <img src="<?php echo e(url('/').'/storage/app/'.$val->image); ?>" class="rounded-3" alt="<?php echo e($val->name); ?>">
                    <div class="card-img-overlay d-flex flex-column align-items-center justify-content-center rounded-3">
                        <span class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-25 rounded-3"></span>
                        <div class="position-relative d-flex zindex-2">
                            <?php if($val->linkedin != null): ?>
                            <a href="<?php echo e($val->linkedin); ?>" target="_blank" class="btn btn-icon btn-secondary btn-linkedin btn-sm bg-white me-2">
                                <i class="bx bxl-linkedin"></i>
                            </a>
                            <?php endif; ?>
                            <?php if($val->twitter != null): ?>
                            <a href="<?php echo e($val->twitter); ?>" target="_blank" class="btn btn-icon btn-secondary btn-twitter btn-sm bg-white">
                                <i class="bx bxl-twitter"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-body text-center p-3">
                    <h3 class="fs-lg fw-semibold pt-1 mb-2"><?php echo e($val->name); ?></h3>
                    <p class="fs-sm mb-0"><?php echo e($val->position); ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php echo $__env->make('partials.livechat', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/soccrquq/clovergatebank.com/resources/views/front/about.blade.php ENDPATH**/ ?>