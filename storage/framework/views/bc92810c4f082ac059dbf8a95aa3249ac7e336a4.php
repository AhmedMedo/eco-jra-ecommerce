<!-- Logo -->
<?php if($mood == 'dark'): ?>
    <div class="logo pl-20 bg-transparent align-items-center d-flex">
        <?php if(sizeof($logo_details) > 0 && isset($logo_details['admin_dark_logo'])): ?>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="default-logo"><img
                    src="<?php echo e(project_asset($logo_details['admin_dark_logo'])); ?>"></a>
        <?php else: ?>
            <h3 class="default-logo text-white"><?php echo e($logo_details['system_name']); ?></h3>
        <?php endif; ?>

        <?php if(sizeof($logo_details) > 0 && isset($logo_details['admin_dark_mobile_logo'])): ?>
            <a href="/" class="mobile-logo"><img
                    src="<?php echo e(project_asset($logo_details['admin_dark_mobile_logo'])); ?>"></a>
        <?php else: ?>
            <h3 class="mobile-logo text-white"><?php echo e($logo_details['system_name']); ?></h3>
        <?php endif; ?>
    </div>
<?php else: ?>
    <div class="logo pl-20 bg-custom align-items-center d-flex">

        <?php if(sizeof($logo_details) > 0 && isset($logo_details['admin_logo'])): ?>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="default-logo"><img
                    src="<?php echo e(project_asset($logo_details['admin_logo'])); ?>"></a>
        <?php else: ?>
            <h3 class="default-logo text-white"><?php echo e($logo_details['system_name']); ?></h3>
        <?php endif; ?>

        <?php if(sizeof($logo_details) > 0 && isset($logo_details['admin_mobile_logo'])): ?>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="mobile-logo"><img
                    src="<?php echo e(project_asset($logo_details['admin_mobile_logo'])); ?>"></a>
        <?php else: ?>
            <h3 class="mobile-logo text-white"><?php echo e($logo_details['system_name']); ?></h3>
        <?php endif; ?>
    </div>
<?php endif; ?>
<!-- End Logo -->
<?php /**PATH /home/ahmedalaa/work/fashly/Core/resources/views/base/layouts/headerLogo.blade.php ENDPATH**/ ?>