<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.users.header', ['type' => $type, 'admin' => $admin, 'client' => $client])->html();
} elseif ($_instance->childHasBeenRendered('e4lkYPa')) {
    $componentId = $_instance->getRenderedChildComponentId('e4lkYPa');
    $componentTag = $_instance->getRenderedChildComponentTagName('e4lkYPa');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('e4lkYPa');
} else {
    $response = \Livewire\Livewire::mount('admin.users.header', ['type' => $type, 'admin' => $admin, 'client' => $client]);
    $html = $response->html();
    $_instance->logRenderedChild('e4lkYPa', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<!-- Block/Unblock User Card -->
<div class="card mb-6">
    <div class="card-header">
        <h3 class="card-title">Account Control</h3>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('admin.user.toggle.block', $client->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="d-flex align-items-center justify-content-between p-4 rounded" style="background: <?php if($client->is_blocked): ?> #fee; <?php else: ?> #f0f9ff; <?php endif; ?>">
                <div>
                    <h5 class="mb-2 <?php if($client->is_blocked): ?> text-danger <?php else: ?> text-dark <?php endif; ?>">
                        <?php if($client->is_blocked): ?>
                            <i class="fas fa-ban me-2"></i>Account Blocked
                        <?php else: ?>
                            <i class="fas fa-check-circle me-2 text-success"></i>Account Active
                        <?php endif; ?>
                    </h5>
                    <p class="text-muted small mb-0">
                        <?php if($client->is_blocked): ?>
                            This user cannot make transfers. All transfer attempts will fail.
                        <?php else: ?>
                            User can make transfers normally.
                        <?php endif; ?>
                    </p>
                </div>
                <button type="submit" class="btn btn-lg <?php if($client->is_blocked): ?> btn-success <?php else: ?> btn-danger <?php endif; ?>">
                    <?php if($client->is_blocked): ?>
                        <i class="fas fa-unlock me-2"></i>Unblock User
                    <?php else: ?>
                        <i class="fas fa-ban me-2"></i>Block User
                    <?php endif; ?>
                </button>
            </div>
        </form>
    </div>
</div>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.users.'.$type, ['type' => $type, 'admin' => $admin, 'client' => $client])->html();
} elseif ($_instance->childHasBeenRendered('tCXVGfh')) {
    $componentId = $_instance->getRenderedChildComponentId('tCXVGfh');
    $componentTag = $_instance->getRenderedChildComponentTagName('tCXVGfh');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('tCXVGfh');
} else {
    $response = \Livewire\Livewire::mount('admin.users.'.$type, ['type' => $type, 'admin' => $admin, 'client' => $client]);
    $html = $response->html();
    $_instance->logRenderedChild('tCXVGfh', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    $(function() {

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#range').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('input[id="range"]').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/admin/user/manage.blade.php ENDPATH**/ ?>