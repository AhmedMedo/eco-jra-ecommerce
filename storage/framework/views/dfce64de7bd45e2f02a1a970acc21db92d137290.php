<!--Theme Options Modules-->
<?php if(auth()->user()->can('Manage Theme settings') ||
        auth()->user()->can('Manage Widget')): ?>
    <li
        class="<?php echo e(Request::routeIs(['theme.fashion-theme.widgets', 'theme.fashion-theme.options']) ? 'active sub-menu-opened' : ''); ?>">
        <a href="#">
            <i class="icofont-ui-theme"></i>
            <span class="link-title"><?php echo e(translate('Theme Options')); ?></span>
        </a>
        <ul class="nav sub-menu">
            <?php if(auth()->user()->can('Manage Theme settings')): ?>
                <li class="<?php echo e(Request::routeIs(['theme.fashion-theme.options']) ? 'active ' : ''); ?>">
                    <a href="<?php echo e(route('theme.fashion-theme.options')); ?>">
                        <?php echo e(translate('Theme settings')); ?>

                    </a>
                </li>
            <?php endif; ?>
            <?php if(auth()->user()->can('Manage Widget')): ?>
                <!--Widget Module-->
                <li class="<?php echo e(Request::routeIs(['theme.fashion-theme.widgets']) ? 'active ' : ''); ?>">
                    <a href="<?php echo e(route('theme.fashion-theme.widgets')); ?>">
                        <?php echo e(translate('Widgets')); ?>

                    </a>
                </li>
                <!--End Widget Module-->
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>
<!--End Theme Options Modules-->
<?php /**PATH /home/medo/work/eco-jara/fashly/themes/fashion-theme/resources/views/backend/includes/themeOptions.blade.php ENDPATH**/ ?>