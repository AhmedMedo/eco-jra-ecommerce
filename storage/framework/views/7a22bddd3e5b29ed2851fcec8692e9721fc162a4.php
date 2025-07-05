<!--Seller Module-->
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Manage Sellers', 'Manage Payouts', 'Manage Payouts Requests', 'Manage Earning History', 'Manage Seller'])): ?>
    <li
        class="<?php echo e(Request::routeIs(['plugin.multivendor.updater', 'plugin.multivendor.admin.seller.earning.list', 'plugin.multivendor.admin.seller.settings', 'plugin.multivendor.admin.seller.details', 'plugin.multivendor.admin.seller.payouts.list', 'plugin.multivendor.admin.seller.payout.requests.list', 'plugin.multivendor.admin.seller.list']) ? 'active sub-menu-opened' : ''); ?>">
        <a href="#">
            <i class="icofont-wallet"></i>
            <span class="link-title"><?php echo e(translate('Sellers')); ?></span><span
                class="badge badge-danger ml-2"><?php echo e(translate('Free Addon')); ?></span>
        </a>
        <ul class="nav sub-menu">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Sellers')): ?>
                <li class="<?php echo e(Request::routeIs(['plugin.multivendor.admin.seller.list']) ? 'active ' : ''); ?>">
                    <a href="<?php echo e(route('plugin.multivendor.admin.seller.list')); ?>"><?php echo e(translate('Sellers')); ?></a>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Payouts')): ?>
                <li class="<?php echo e(Request::routeIs(['plugin.multivendor.admin.seller.payouts.list']) ? 'active ' : ''); ?>">
                    <a href="<?php echo e(route('plugin.multivendor.admin.seller.payouts.list')); ?>"><?php echo e(translate('Payouts')); ?></a>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Payout Requests')): ?>
                <li class="<?php echo e(Request::routeIs(['plugin.multivendor.admin.seller.payout.requests.list']) ? 'active ' : ''); ?>">
                    <a
                        href="<?php echo e(route('plugin.multivendor.admin.seller.payout.requests.list')); ?>"><?php echo e(translate('Payouts Requests')); ?></a>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Earning History')): ?>
                <li class="<?php echo e(Request::routeIs(['plugin.multivendor.admin.seller.earning.list']) ? 'active ' : ''); ?>">
                    <a
                        href="<?php echo e(route('plugin.multivendor.admin.seller.earning.list')); ?>"><?php echo e(translate('Earning History')); ?></a>
                </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Seller Settings')): ?>
                <li class="<?php echo e(Request::routeIs(['plugin.multivendor.admin.seller.settings']) ? 'active ' : ''); ?>">
                    <a href="<?php echo e(route('plugin.multivendor.admin.seller.settings')); ?>"><?php echo e(translate('Settings')); ?></a>
                </li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>
<!--End Seller Module-->
<?php /**PATH /home/ahmedalaa/work/fashly/plugins/multivendor/views/includes/navbar.blade.php ENDPATH**/ ?>