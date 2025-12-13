<?php if(!in_array($set->default_font, ['HKGroteskPro', 'Graphik'])): ?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=<?php echo e($set->default_font); ?>:wght@300;400;500;700&display=swap');
</style>
<?php endif; ?>
<?php if($set->default_font == "HKGroteskPro"): ?>
    <style>
        @font-face{
            font-family:'HKGroteskPro';
            font-weight:400;
            src:url(<?php echo e(asset('asset/fonts/HKGroteskPro/HKGroteskPro-Regular.woff2')); ?>) format("woff2"),
            url(<?php echo e(asset('asset/fonts/HKGroteskPro/HKGroteskPro-Regular.woff')); ?>) format("woff")
        }
        @font-face{
            font-family:'HKGroteskPro';
            font-weight:500;
            src:url(<?php echo e(asset('asset/fonts/HKGroteskPro/HKGroteskPro-Medium.woff2')); ?>) format("woff2"),
            url(<?php echo e(asset('asset/fonts/HKGroteskPro/HKGroteskPro-Medium.woff')); ?>) format("woff")
        }
        @font-face{
            font-family:'HKGroteskPro';
            font-weight:700;
            src:url(<?php echo e(asset('asset/fonts/HKGroteskPro/HKGroteskPro-Bold.woff2')); ?>) format("woff2"),
            url(<?php echo e(asset('asset/fonts/HKGroteskPro/HKGroteskPro-Bold.woff')); ?>) format("woff")
        }  
        @font-face{
            font-family:'HKGroteskPro';
            font-weight:600;
            src:url(<?php echo e(asset('asset/fonts/HKGroteskPro/HKGroteskPro-SemiBold.woff2')); ?>) format("woff2"),
            url(<?php echo e(asset('asset/fonts/HKGroteskPro/HKGroteskPro-SemiBold.woff')); ?>) format("woff")
        }
    </style>
<?php endif; ?>

<?php if($set->default_font == "Graphik"): ?>
    <style>
        @font-face {
        font-family: Graphik;
        font-weight: 400;
        src: url(<?php echo e(asset('asset/fonts/Graphik/GraphikRegular.otf')); ?>);
    }

    @font-face {
        font-family: Graphik;
        font-weight: 500;
        src: url(<?php echo e(asset('asset/fonts/Graphik/GraphikRegular.otf')); ?>);
    }

    @font-face {
        font-family: Graphik;
        font-weight: 700;
        src: url(<?php echo e(asset('asset/fonts/Graphik/GraphikMedium.otf')); ?>);
    }

    @font-face {
        font-family: Graphik;
        font-weight: 800;
        src: url(<?php echo e(asset('asset/fonts/Graphik/GraphikBold.otf')); ?>);
    }

    @font-face {
        font-family: Graphik;
        font-weight: 900;
        src: url(<?php echo e(asset('asset/fonts/Graphik/GraphikMedium.otf')); ?>);
    }
</style>
<?php endif; ?>

<style>

.iti {
    position: relative;
    display: block;
}

body
{
    font-family: "<?php echo e($set->default_font); ?>", sans-serif;
}
pre,code,kbd,samp
{
    font-family: "<?php echo e($set->default_font); ?>", Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace;
}
.tooltip
{
    font-family: "<?php echo e($set->default_font); ?>", sans-serif;
}
.popover
{
    font-family: "<?php echo e($set->default_font); ?>", sans-serif;
}
.text-monospace
{
    font-family: "<?php echo e($set->default_font); ?>", Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace !important;
}
.btn-group-colors > .btn:before
{
    font-family: "<?php echo e($set->default_font); ?>", sans-serif;
}
.has-danger:after
{
    font-family: '<?php echo e($set->default_font); ?>';
}
.fc-icon
{
    font-family: "<?php echo e($set->default_font); ?>", sans-serif;
}
.ql-container
{
    font-family: "<?php echo e($set->default_font); ?>", sans-serif;
}
</style>

<style>
    .page-loading {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        -webkit-transition: all .4s .2s ease-in-out;
        transition: all .4s .2s ease-in-out;
        background-color:#fff;
        visibility: hidden;
        z-index: 9999;
    }

    .page-loading.active {
        opacity: 1;
        visibility: visible;
    }

    .page-loading-inner {
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        text-align: center;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        -webkit-transition: opacity .2s ease-in-out;
        transition: opacity .2s ease-in-out;
        opacity: 0;
    }

    .page-loading.active>.page-loading-inner {
        opacity: 1;
    }

    .page-loading-inner>span {
        display: block;
        font-size: 1rem;
        font-weight: normal;
        color: #000;
    }

    .page-spinner {
        display: inline-block;
        width: 2.75rem;
        height: 2.75rem;
        margin-bottom: .75rem;
        vertical-align: text-bottom;
        border: .15em solid #820cd7;
        border-right-color: transparent;
        border-radius: 50%;
        -webkit-animation: spinner .75s linear infinite;
        animation: spinner .75s linear infinite;
    }

    @-webkit-keyframes spinner {
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes spinner {
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }
</style><?php /**PATH C:\xampp\htdocs\adv-banking\resources\views/partials/font.blade.php ENDPATH**/ ?>