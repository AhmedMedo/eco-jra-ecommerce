<?php if(isActivePlugin('pickuppoint')): ?>
    <li
        class="<?php echo e(Request::routeIs(['plugin.pickuppoint.edit.pickup.point', 'plugin.pickuppoint.pickup.points']) ? 'active ' : ''); ?>">
        <a href="<?php echo e(route('plugin.pickuppoint.pickup.points')); ?>"><?php echo e(translate('Pickup Points')); ?><span
                class="badge badge-danger ml-2"><?php echo e(translate('Free Addon')); ?></span></a>
    </li>
<?php endif; ?>
<?php /**PATH /home/ahmedalaa/work/fashly/plugins/pickuppoint/views/includes/submenu/shipping.blade.php ENDPATH**/ ?>