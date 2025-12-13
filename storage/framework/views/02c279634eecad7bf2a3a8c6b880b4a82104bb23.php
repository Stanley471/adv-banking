<div>
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <h1 class="text-dark fw-bolder my-1 fs-2"><?php echo e(__('Clients')); ?></h1>
                <ul class="breadcrumb fw-semibold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-muted text-hover-primary"><?php echo e(__('Dashboard')); ?></a>
                    </li>
                    <li class="breadcrumb-item text-dark"><?php echo e(__('Clients')); ?></li>
                </ul>
            </div>
            <div class="d-flex align-items-center flex-nowrap text-nowrap py-1">
                <button data-bs-toggle="modal" data-bs-target="#filter" class="btn btn-white text-dark me-4"><i class="fal fa-filter-list"></i> <?php echo e(__('Filter')); ?></button>
                <button id="kt_user_button" class="btn btn-dark me-4"><i class="fal fa-plus"></i> <?php echo e(__('Add a User')); ?></button>
            </div>
        </div>
    </div>
    <div wire:ignore.self id="kt_user" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_user_button" data-kt-drawer-close="#kt_user_close" data-kt-drawer-width="{'md': '500px'}">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1"><?php echo e(__('Create a User')); ?></div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_user_close">
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
                            <i class="fal fa-user-plus fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="pb-5 mt-10 position-relative zindex-1">
                    <form class="form w-100 mb-10" wire:submit.prevent="addUser" method="post">
                        <div class="row fv-row mb-6">
                            <div class="col-xl-6">
                                <label class="form-label fw-bolder text-dark fs-6"><?php echo e(__('Legal First Name')); ?></label>
                                <input class="form-control form-control-lg form-control-solid border-light" type="text" wire:model.defer="first_name" autocomplete="off" placeholder="John" />
                                <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="form-text"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-xl-6">
                                <label class="form-label fw-bolder text-dark fs-6"><?php echo e(__('Legal Last Name')); ?></label>
                                <input class="form-control form-control-lg form-control-solid border-light" type="text" wire:model.defer="last_name" autocomplete="off" placeholder="Doe" />
                                <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="form-text"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="fv-row mb-6">
                            <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Email')); ?></label>
                            <input class="form-control form-control-lg form-control-solid border-light" type="email" wire:model.defer="email" autocomplete="email" placeholder="name@email.com" />
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="form-text"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="fv-row mb-6" wire:ignore>
                            <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Phone Number')); ?></label>
                            <input type="hidden" wire:model="mobile_code" id="code" class="text-uppercase">
                            <input type="tel" id="phone" wire:model.defer="mobile" class="form-control form-control-lg form-control-solid border-light" required>
                        </div>
                        <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="form-text mb-6 mt-n6"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="fv-row mb-6">
                            <label class="form-label fw-bolder text-dark fs-6"><?php echo e(__('Referral Merchant ID')); ?></label>
                            <input class="form-control form-control-lg form-control-solid border-light" type="text" wire:model.defer="username" autocomplete="off" placeholder="Optional" />
                            <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="form-text"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="fv-row mb-6">
                            <label class="form-label fw-bolder text-dark fs-6"><?php echo e(__('Password')); ?></label>
                            <input class="form-control form-control-lg form-control-solid border-light" type="text" wire:model.defer="password" autocomplete="off" required data-toggle="password" id="password" placeholder="XXXXXXXXX" />
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="form-text"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="text-center mt-10">
                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                <span wire:loading.remove wire:target="addUser"><?php echo e(__('Create User')); ?></span>
                                <span wire:loading wire:target="addUser"><?php echo e(__('Processing Request...')); ?></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><?php echo e(__('Filter Client')); ?></h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
                <div class="modal-body">
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
                            <option value="created_at"><?php echo e(__('Date')); ?></option>
                            <option value="first_name"><?php echo e(__('Name')); ?></option>
                            <option value="email"><?php echo e(__('Email')); ?></option>
                        </select>
                    </div>
                    <div class="fv-row mb-6">
                        <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Status')); ?></label>
                        <select class="form-select form-select-solid" wire:model="status">
                            <option value=""><?php echo e(__('All')); ?></option>
                            <option value="0"><?php echo e(__('Active')); ?></option>
                            <option value="1"><?php echo e(__('Blocked')); ?></option>
                        </select>
                    </div>
                    <div class="fv-row mb-6">
                        <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Email verified')); ?></label>
                        <select class="form-select form-select-solid" wire:model="email_verified">
                            <option value=""><?php echo e(__('All')); ?></option>
                            <option value="0"><?php echo e(__('Pending')); ?></option>
                            <option value="1"><?php echo e(__('Verified')); ?></option>
                        </select>
                    </div>
                    <div class="fv-row mb-6">
                        <label class="form-label fs-6 fw-bolder text-dark"><?php echo e(__('Phone verified')); ?></label>
                        <select class="form-select form-select-solid" wire:model="phone_verified">
                            <option value=""><?php echo e(__('All')); ?></option>
                            <option value="0"><?php echo e(__('Pending')); ?></option>
                            <option value="1"><?php echo e(__('Verified')); ?></option>
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
                <div class="col-lg-12 col-md-12">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="col-md-12">
                            <div class="input-group input-group-solid mb-5 rounded-4">
                                <span class="input-group-text" id="basic-addon1"><i class="fal fa-search"></i></span>
                                <input type="search" class="form-control form-control-solid text-dark" wire:model="search" placeholder="<?php echo e(__('Search Clients, name, email, phone')); ?>" />
                            </div>
                        </div>
                    </div>
                    <?php if($clients->count() > 0): ?>
                    <div class="table-responsive">
                        <table id="kt_datatable_zero_configuration" class="table table-row-bordered gy-5" wire:loading.class.delay="opacity-50" wire:target="search, status, sortBy, orderBy, perPage, loadMore">
                            <thead>
                                <tr class="fw-semibold fs-6 text-muted">
                                    <th class="min-w-20px"><?php echo e(__('S/N')); ?></th>
                                    <th class="min-w-100px"><?php echo e(__('Name')); ?></th>
                                    <th class="50px"><?php echo e(__('Status')); ?></th>
                                    <th class="min-w-50px"><?php echo e(__('Created')); ?></th>
                                    <th class="scope"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?>.</td>
                                    <td><?php echo e($val->first_name.' '.$val->last_name); ?></td>
                                    <td>
                                        <?php if($val->status==0): ?>
                                        <span class="badge badge-pill badge-info"><?php echo e(__('Active')); ?></span>
                                        <?php elseif($val->status==1): ?>
                                        <span class="badge badge-pill badge-danger"><?php echo e(__('Blocked')); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></td>
                                    <td class="text-center">
                                        <a href="<?php echo e(route('user.manage', ['client' => $val->id, 'type' => 'details'])); ?>" class="btn btn-sm btn-light-info">Manage</a>
                                        <button id="kt_devices_<?php echo e($val->id); ?>_button" class="btn btn-sm btn-info">Devices</button>
                                        <?php if($val->status==0): ?>
                                        <a wire:click="block('<?php echo e($val->id); ?>')" class="btn btn-sm btn-secondary">Block</a>
                                        <?php else: ?>
                                        <a wire:click="unblock('<?php echo e($val->id); ?>')" class="btn btn-sm btn-secondary">Unblock</a>
                                        <?php endif; ?>
                                        <a data-bs-toggle="modal" data-bs-target="#delete<?php echo e($val->id); ?>" href="" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php if($clients->total() > 0 && $clients->count() < $clients->total()): ?><button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block"><?php echo e(__('See more')); ?></button><?php endif; ?>
                    </div>
                    <?php else: ?>
                    <div class="text-center mt-20">
                        <img src="<?php echo e(asset('asset/images/beneficiary.png')); ?>" style="height:auto; max-width:250px;" class="mb-6">
                        <h3 class="text-dark"><?php echo e(__('No Client Found')); ?></h3>
                        <p class="text-dark"><?php echo e(__('We couldn\'t find any client')); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.users.edit-users', ['val' => $val,'admin' => $admin])->html();
} elseif ($_instance->childHasBeenRendered('kt_devices_'. $val->id)) {
    $componentId = $_instance->getRenderedChildComponentId('kt_devices_'. $val->id);
    $componentTag = $_instance->getRenderedChildComponentTagName('kt_devices_'. $val->id);
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('kt_devices_'. $val->id);
} else {
    $response = \Livewire\Livewire::mount('admin.users.edit-users', ['val' => $val,'admin' => $admin]);
    $html = $response->html();
    $_instance->logRenderedChild('kt_devices_'. $val->id, $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->startPush('scripts'); ?>
<script>
    window.livewire.on('closeDrawer', function() {
        KTDrawer.hideAll();
        KTDrawer.createInstances();
    });
    window.livewire.on('drawer', data => {
        KTDrawer.hideAll();
        KTDrawer.createInstances();
    });
    window.livewire.on('closeModal', function(data) {
        var myModal = $(`#delete${data}`);
        myModal.modal('hide');
    });
    window.livewire.on('closeDeclineModal', function(data) {
        var myModal = $(`#declineKYC`);
        myModal.modal('hide');
    });
</script>
<script src="<?php echo e(asset('front/vendor/jquery/dist/jquery.min.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script>
    function initPhoneToggle() {
        const phoneInputField = document.querySelector("#phone");
        const phoneInput = window.intlTelInput(phoneInputField, {
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });
        var old = "<?php echo e(old('code')); ?>";
        if (old.trim() != '') {
            phoneInput.setCountry(old)
        }
        $('#code').val(phoneInput.getSelectedCountryData().iso2);
        window.livewire.find('<?php echo e($_instance->id); ?>').set('mobile_code', phoneInput.getSelectedCountryData().iso2);
        phoneInputField.addEventListener("countrychange", function() {
            $('#code').val(phoneInput.getSelectedCountryData().iso2);
            window.livewire.find('<?php echo e($_instance->id); ?>').set('mobile_code', phoneInput.getSelectedCountryData().iso2);
        });
    }
    document.addEventListener('livewire:load', function() {
        initPhoneToggle();
    });
    $(document).ready(function() {
        initPhoneToggle();
    });
</script>
<?php $__env->stopPush(); ?><?php /**PATH /home/soccrquq/clovergatebank.com/resources/views/livewire/admin/users/index.blade.php ENDPATH**/ ?>