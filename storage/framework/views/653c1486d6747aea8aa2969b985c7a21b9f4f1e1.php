<?php $__env->startSection('content'); ?>
<?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('transactions.all', ['user' => $user])->html();
} elseif ($_instance->childHasBeenRendered('hD68gW6')) {
    $componentId = $_instance->getRenderedChildComponentId('hD68gW6');
    $componentTag = $_instance->getRenderedChildComponentTagName('hD68gW6');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('hD68gW6');
} else {
    $response = \Livewire\Livewire::mount('transactions.all', ['user' => $user]);
    $html = $response->html();
    $_instance->logRenderedChild('hD68gW6', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
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
<?php echo $__env->make('user.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/user/transactions/index.blade.php ENDPATH**/ ?>