<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.users.header', ['type' => $type, 'admin' => $admin, 'client' => $client])->html();
} elseif ($_instance->childHasBeenRendered('KWqUN20')) {
    $componentId = $_instance->getRenderedChildComponentId('KWqUN20');
    $componentTag = $_instance->getRenderedChildComponentTagName('KWqUN20');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('KWqUN20');
} else {
    $response = \Livewire\Livewire::mount('admin.users.header', ['type' => $type, 'admin' => $admin, 'client' => $client]);
    $html = $response->html();
    $_instance->logRenderedChild('KWqUN20', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.users.'.$type, ['type' => $type, 'admin' => $admin, 'client' => $client])->html();
} elseif ($_instance->childHasBeenRendered('4tpYl9R')) {
    $componentId = $_instance->getRenderedChildComponentId('4tpYl9R');
    $componentTag = $_instance->getRenderedChildComponentTagName('4tpYl9R');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('4tpYl9R');
} else {
    $response = \Livewire\Livewire::mount('admin.users.'.$type, ['type' => $type, 'admin' => $admin, 'client' => $client]);
    $html = $response->html();
    $_instance->logRenderedChild('4tpYl9R', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
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