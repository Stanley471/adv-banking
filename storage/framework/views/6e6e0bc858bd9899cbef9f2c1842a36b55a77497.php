<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.payout.header', ['type' => $type, 'admin' => $admin])->html();
} elseif ($_instance->childHasBeenRendered('qEGfWEU')) {
    $componentId = $_instance->getRenderedChildComponentId('qEGfWEU');
    $componentTag = $_instance->getRenderedChildComponentTagName('qEGfWEU');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('qEGfWEU');
} else {
    $response = \Livewire\Livewire::mount('admin.payout.header', ['type' => $type, 'admin' => $admin]);
    $html = $response->html();
    $_instance->logRenderedChild('qEGfWEU', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.payout.index', ['base' => $type, 'admin' => $admin, 'set' => $set])->html();
} elseif ($_instance->childHasBeenRendered('5sfl6Yw')) {
    $componentId = $_instance->getRenderedChildComponentId('5sfl6Yw');
    $componentTag = $_instance->getRenderedChildComponentTagName('5sfl6Yw');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('5sfl6Yw');
} else {
    $response = \Livewire\Livewire::mount('admin.payout.index', ['base' => $type, 'admin' => $admin, 'set' => $set]);
    $html = $response->html();
    $_instance->logRenderedChild('5sfl6Yw', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
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

    window.livewire.on('drawer', data => {
        KTDrawer.createInstances();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/admin/payout/index.blade.php ENDPATH**/ ?>