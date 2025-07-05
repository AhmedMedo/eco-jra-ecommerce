<?php if(auth()->user()->can('Manage Seller Orders')): ?>
    <li class="<?php echo e(Request::routeIs(['plugin.multivendor.admin.seller.order.list']) ? 'active ' : ''); ?>">
        <a href="<?php echo e(route('plugin.multivendor.admin.seller.order.list')); ?>"><?php echo e(translate('Seller Orders')); ?></a><span
            class="badge badge-danger ml-2"><?php echo e(translate('Free Addon')); ?></span>
    </li>
<?php endif; ?>
<?php /**PATH /home/ahmedalaa/work/fashly/plugins/multivendor/views/includes/submenu/order.blade.php ENDPATH**/ ?>