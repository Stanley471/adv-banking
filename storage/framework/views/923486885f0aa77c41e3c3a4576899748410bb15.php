<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.users.header', ['type' => $type, 'admin' => $admin, 'client' => $client])->html();
} elseif ($_instance->childHasBeenRendered('lFnjt4k')) {
    $componentId = $_instance->getRenderedChildComponentId('lFnjt4k');
    $componentTag = $_instance->getRenderedChildComponentTagName('lFnjt4k');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('lFnjt4k');
} else {
    $response = \Livewire\Livewire::mount('admin.users.header', ['type' => $type, 'admin' => $admin, 'client' => $client]);
    $html = $response->html();
    $_instance->logRenderedChild('lFnjt4k', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('admin.users.'.$type, ['type' => $type, 'admin' => $admin, 'client' => $client])->html();
} elseif ($_instance->childHasBeenRendered('D8zqaJz')) {
    $componentId = $_instance->getRenderedChildComponentId('D8zqaJz');
    $componentTag = $_instance->getRenderedChildComponentTagName('D8zqaJz');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('D8zqaJz');
} else {
    $response = \Livewire\Livewire::mount('admin.users.'.$type, ['type' => $type, 'admin' => $admin, 'client' => $client]);
    $html = $response->html();
    $_instance->logRenderedChild('D8zqaJz', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
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
<?php echo $__env->make('admin.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/soccrquq/clovergatebank.com/resources/views/admin/user/manage.blade.php ENDPATH**/ ?>