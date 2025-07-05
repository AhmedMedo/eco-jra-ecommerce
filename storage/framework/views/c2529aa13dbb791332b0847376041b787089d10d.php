<?php
    $isactivatePickupPoint = isActivePlugin('pickuppoint');
?>
<?php if($isactivatePickupPoint): ?>
    <?php if(auth()->user()->can('Manage Pickup Point Order')): ?>
        <li class="<?php echo e(Request::routeIs(['plugin.pickuppoint.orders']) ? 'active ' : ''); ?>">
            <a href="<?php echo e(route('plugin.pickuppoint.orders')); ?>"><?php echo e(translate('Pickup Point Order')); ?></a><span
                class="badge badge-danger ml-2"><?php echo e(translate('Free Addon')); ?></span>
        </li>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /home/medo/work/eco-jara/fashly/plugins/pickuppoint/views/includes/submenu/order.blade.php ENDPATH**/ ?>