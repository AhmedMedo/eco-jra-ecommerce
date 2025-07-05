<?php $__env->startSection('title'); ?>
    <?php echo e(translate('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom_css'); ?>
    <!-- ======= BEGIN PAGE LEVEL PLUGINS STYLES ======= -->
    <link rel="stylesheet" href="<?php echo e(asset('web-assets/backend/plugins/apex/apexcharts.css')); ?>">
    <!-- ======= END BEGIN PAGE LEVEL PLUGINS STYLES ======= -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
    <?php if(collect(getActivePluginDashboard())->count() > 0): ?>
        <?php $__currentLoopData = collect(getActivePluginDashboard()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if ($__env->exists($item)) echo $__env->make($item, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <h1>Core Dashboard</h1>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom_scripts'); ?>
    <!-- ======= BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS ======= -->
    <script src="<?php echo e(asset('web-assets/backend/plugins/apex/apexcharts.min.js')); ?>"></script>
    <!-- ======= End BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS ======= -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('core::base.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ahmedalaa/work/fashly/Core/resources/views/base/dashboard/index.blade.php ENDPATH**/ ?>